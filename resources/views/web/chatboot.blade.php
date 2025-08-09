<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>UMURINZI Chatbot</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
    }

    /* Floating Button with Animation */
    .chat-button {
      position: fixed;
      bottom: 70px;
      right: 20px;
      background-color: #ffc107; /* Yellow */
      color: black;
      border: none;
      border-radius: 50%;
      width: 60px;
      height: 60px;
      cursor: pointer;
      box-shadow: 0 4px 12px rgba(0,0,0,0.3);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
      z-index: 9999;
      animation: pulse 2s infinite;
      transition: transform 0.3s ease;
    }

    .chat-button:hover {
      transform: scale(1.1);
    }

    @keyframes pulse {
      0% {
        box-shadow: 0 0 0 0 rgba(255,193,7, 0.7);
      }
      70% {
        box-shadow: 0 0 0 15px rgba(255,193,7, 0);
      }
      100% {
        box-shadow: 0 0 0 0 rgba(255,193,7, 0);
      }
    }

    /* Chat Window */
    .chat-window {
      position: fixed;
      bottom: 90px;
      right: 20px;
      width: 300px;
      max-height: 400px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.3);
      display: none;
      flex-direction: column;
      overflow: hidden;
      z-index: 9999;
    }

    .chat-header {
      background-color: #071839;
      color: white;
      padding: 12px;
      font-weight: bold;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .chat-messages {
      padding: 10px;
      flex: 1;
      overflow-y: auto;
      background: #f5f5f5;
    }

    .message {
      margin-bottom: 10px;
      padding: 8px 10px;
      border-radius: 12px;
      max-width: 80%;
      font-size: 14px;
    }

    .user {
      background-color: #374b61ff;
      align-self: flex-end;
    }

    .bot {
      background-color: #4d3d3dff;
      align-self: flex-start;
    }

    .chat-input {
      display: flex;
      border-top: 1px solid #ddd;
    }

    .chat-input input {
      flex: 1;
      padding: 10px;
      border: none;
      outline: none;
      font-size: 14px;
    }

    .chat-input button {
      background-color: #071839;
      color: white;
      border: none;
      padding: 0 16px;
      cursor: pointer;
    }

    @media (max-width: 500px) {
      .chat-window {
        width: 90%;
        right: 5%;
        bottom: 80px;
      }
    }
  </style>
</head>
<body>

<!-- Floating Chat Button -->
<button class="chat-button" id="chatToggle">
  💬
</button>

<!-- Chat Window -->
<div class="chat-window" id="chatWindow">
  <div class="chat-header">
    Need help?
    <span style="cursor:pointer;" id="chatClose">✖</span>
  </div>
  <div class="chat-messages" id="chatMessages">
    <div class="message bot">Hi there 👋<br>How can I help you today?</div>
  </div>
  <div class="chat-input">
    <input type="text" id="userInput" placeholder="Type your message..." />
    <button id="sendBtn">➤</button>
  </div>
</div>

<script>
  const chatToggle = document.getElementById('chatToggle');
  const chatWindow = document.getElementById('chatWindow');
  const chatClose = document.getElementById('chatClose');
  const sendBtn = document.getElementById('sendBtn');
  const userInput = document.getElementById('userInput');
  const chatMessages = document.getElementById('chatMessages');

  // Toggle chat window
  chatToggle.addEventListener('click', () => {
    chatWindow.style.display = 'flex';
    chatToggle.style.display = 'none';
  });

  chatClose.addEventListener('click', () => {
    chatWindow.style.display = 'none';
    chatToggle.style.display = 'flex';
  });

  // Send message
  sendBtn.addEventListener('click', sendMessage);
  userInput.addEventListener('keypress', e => {
    if (e.key === 'Enter') sendMessage();
  });

  function sendMessage() {
    const text = userInput.value.trim();
    if (!text) return;

    appendMessage(text, 'user');
    userInput.value = '';
    setTimeout(() => {
      const reply = getBotReply(text);
      appendMessage(reply, 'bot');
    }, 600);
  }

  function appendMessage(text, sender) {
    const msg = document.createElement('div');
    msg.className = `message ${sender}`;
    msg.textContent = text;
    chatMessages.appendChild(msg);
    chatMessages.scrollTop = chatMessages.scrollHeight;
  }

  function getBotReply(input) {
    // Simple example logic
    const lower = input.toLowerCase();
    if (lower.includes('hello') || lower.includes('hi')) return "Hello! How can I assist you?";
    if (lower.includes('price')) return "Our pricing depends on the package you choose. Can you tell me more about your needs?";
    if (lower.includes('thanks')) return "You're welcome!";
    if (lower.includes('bye')) return "Goodbye! Have a great day!";
    return "I'm not sure I understand. Could you please rephrase?";
  }
</script>
</body>
</html>
