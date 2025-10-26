    <div class="chatbot-widget">
      <button id="chatbotToggleButton" class="chatbot-toggle" onmouseenter="CommonLib.showTooltip(event, 'Chatbot');">
        <span class="icon icon--1-5rem material-symbols-outlined">
          chat
        </span>
      </button>
      <div id="chatbotContainer" class="chatbot-container hidden">
        <div class="chatbot-header">
          <span class="title">SMAPES Bot 🤖</span>
          <button id="chatbotCloseButton" class="chatbot-close-button">
            <span class="icon icon--1-5rem material-symbols-outlined">
              close
            </span>
          </button>
        </div>
        <div id="chatbotBox" class="chatbot-box"></div>
        <div class="input-area">
          <input id="chatbotUserInput" placeholder="Type a message...">
          <button id="chatbotSendButton">
            <span class="icon icon--1-5rem material-symbols-outlined">
              send
            </span>
          </button>
        </div>
      </div>
    </div>