<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Business Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    /* Unique Business Styles */
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f9fafc;
    }

    .biz-container {
      padding: 2rem 1rem;
      max-width: 1200px;
      margin: auto;
      text-align: center;
    }

    .biz-title {
      font-size: 2rem;
      color: #0a0a23;
      margin-bottom: 1.5rem;
    }

    .biz-tabs {
      display: flex;
      justify-content: center;
      gap: 1rem;
      margin-bottom: 2rem;
      flex-wrap: wrap;
    }

    .biz-tab-button {
      padding: 0.75rem 1.5rem;
      border: none;
      background-color: #f2f2f2;
      color: #0a0a23;
      border-radius: 2rem;
      cursor: pointer;
      transition: 0.3s ease;
      font-weight: bold;
    }

    .biz-tab-button.active {
      background-color: #00264d;
      color: white;
    }

    .biz-section-container {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .biz-section {
      background: #f0f4f8;
      padding: 2rem;
      border-radius: 1rem;
      width: 100%;
      max-width: 1000px;
    }

    .hidden {
      display: none;
    }

    .biz-section-content {
      display: flex;
      flex-direction: row;
      gap: 2rem;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
    }

    .biz-text {
      flex: 1 1 300px;
      text-align: left;
    }

    .biz-text h2 {
      font-size: 1.8rem;
      color: #00264d;
    }

    .biz-text p {
      margin-top: 1rem;
      color: #444;
      font-size: 1rem;
    }

    .biz-start-button {
      margin-top: 1.5rem;
      background: #ffb700;
      border: none;
      padding: 0.75rem 1.5rem;
      border-radius: 2rem;
      font-weight: bold;
      color: #0a0a23;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .biz-start-button:hover {
      background: #e6a800;
    }

    .biz-image img {
      max-width: 500px;
      max-height: 400px;
      width: auto;
      height: auto;
      border-radius: 0.5rem;
      object-fit: contain;
      display: block;
      margin-left: auto;
      margin-right: auto;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .biz-section-content {
        flex-direction: column;
        text-align: center;
      }

      .biz-text {
        text-align: center;
      }
    }
  </style>
</head>
<body>
  <div class="biz-container">
    <h1 class="biz-title">All you need to run your business profitably</h1>

    <div class="biz-tabs">
      <button class="biz-tab-button active" data-target="manage">
        <i class="fa fa-briefcase"></i> Manage Business
      </button>
      <button class="biz-tab-button" data-target="track">
        <i class="fa fa-money-check-alt"></i> Track Transactions
      </button>
      <button class="biz-tab-button" data-target="grow">
        <i class="fa fa-money-check-alt"></i> Grow Business
      </button>
    </div>

    <div class="biz-section-container">
      <!-- Manage Business Section -->
      <div class="biz-section" id="manage">
        <div class="biz-section-content">
          <div class="biz-text">
            <h2>Stay in Control, From Stock to Sale</h2>
            <p>
              Keep track of your stock levels, monitor sales in real-time, and set up automatic reordering to ensure you never run out of essential items.
            </p>
            <button class="biz-start-button">Get started →</button>
          </div>
          <div class="biz-image">
            <img src="{{asset('images/reparts.png')}}" alt="Dashboard" />
          </div>
        </div>
      </div>

      <!-- Track Transactions Section -->
      <div class="biz-section hidden" id="track">
        <div class="biz-section-content">
          <div class="biz-text">
            <h2>Track Every Transaction Seamlessly</h2>
            <p>
              Record sales, manage invoices, and access transaction history to stay on top of your financials.
            </p>
            <button class="biz-start-button">Get started →</button>
          </div>
          <div class="biz-image">
            <img src="{{asset('images/banner.jpeg')}}" alt="Transactions" />
          </div>
        </div>
      </div>

      <!-- Grow Business Section -->
      <div class="biz-section hidden" id="grow">
        <div class="biz-section-content">
          <div class="biz-text">
            <h2>Grow Your Business with Insights</h2>
            <p>
              Use analytics and reports to make informed decisions and scale your business strategically.
            </p>
            <button class="biz-start-button">Get started →</button>
          </div>
          <div class="biz-image">
            <img src="{{asset('images/show.png')}}" alt="Growth" />
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Script for tab switch
    document.querySelectorAll('.biz-tab-button').forEach(button => {
      button.addEventListener('click', () => {
        // Remove active class from all buttons
        document.querySelectorAll('.biz-tab-button').forEach(btn => btn.classList.remove('active'));
        button.classList.add('active');

        const targetId = button.getAttribute('data-target');

        // Hide all sections
        document.querySelectorAll('.biz-section').forEach(section => {
          section.classList.add('hidden');
        });

        // Show the selected section
        document.getElementById(targetId).classList.remove('hidden');
      });
    });
  </script>
</body>
</html>
