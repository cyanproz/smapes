// server.js
require("dotenv").config();
const { loadKnowledgeBase } = require("./knowledge");
const knowledgeText = loadKnowledgeBase();
const express = require("express");
const path = require("path");
const cookieParser = require("cookie-parser");
const crypto = require("crypto");
const { GoogleGenAI } = require("@google/genai");

const app = express();
const PORT = process.env.PORT || 3000;

app.use(express.json());
app.use(cookieParser());
app.use(express.static(path.join(__dirname, "public")));

const client = new GoogleGenAI({ apiKey: process.env.GEMINI_API_KEY });

// Chat histories per session
let chatHistories = {};

// Middleware: assign sessionId if not yet present
app.use((req, res, next) => {
    if (!req.cookies.sessionId) {
        const sessionId = crypto.randomBytes(16).toString("hex");
        res.cookie("sessionId", sessionId, {
            httpOnly: true,
            sameSite: "lax",
            secure: false, // ubah ke true jika pakai HTTPS
            maxAge: 1000 * 60 * 60 * 24 * 7, // 1 minggu
        });
        req.sessionId = sessionId;
    } else {
        req.sessionId = req.cookies.sessionId;
    }
    next();
});

app.post("/api/chat", async (req, res) => {
    try {
        const { message } = req.body;
        if (!message) return res.status(400).json({ error: "Message required" });

        const sessionId = req.sessionId;
        if (!chatHistories[sessionId]) chatHistories[sessionId] = [];

        // Build conversation context
        let prompt = `Kamu adalah chatbot ramah lingkungan bernama SMAPES-Bot. Sapa pengunjung dengan panggilan SMAPES Buddy HANYA JIKA pengunjung sapa duluan seperti "Halo", "Hello", dll. Jawab singkat dan jelas dalam bahasa Indonesia.
        Gunakan informasi berikut bila relevan:\n${knowledgeText}\n\n`;
        for (const turn of chatHistories[sessionId]) {
            prompt += `User: ${turn.user}\nSMAPES-Bot: ${turn.bot}\n\n`;
        }
        prompt += `User: ${message}\nSMAPES-Bot:`;

        // Call Gemini API
        const response = await client.models.generateContent({
            model: "gemini-2.5-flash",
            contents: prompt,
            temperature: 0.3,
            maxOutputTokens: 300,
        });

        const reply = response?.text || "Maaf, saya tidak bisa menjawab sekarang.";

        // Save conversation
        chatHistories[sessionId].push({ user: message, bot: reply });

        res.json({ reply });
    } catch (err) {
        console.error(err);
        res.status(500).json({ error: "Server error" });
    }
});

app.listen(PORT, () => {
    console.log(`Server running at http://localhost:${PORT}`);
});
