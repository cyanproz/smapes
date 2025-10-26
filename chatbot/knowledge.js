// knowledge.js
const fs = require('fs');
const path = require('path');

function loadKnowledgeBase() {
  const dir = path.join(__dirname, 'knowledge-base');
  const files = fs.readdirSync(dir);
  let knowledgeText = '';

  for (const file of files) {
    const content = fs.readFileSync(path.join(dir, file), 'utf-8');
    knowledgeText += `\n=== ${file} ===\n${content}\n`;
  }

  return knowledgeText;
}

module.exports = { loadKnowledgeBase };
