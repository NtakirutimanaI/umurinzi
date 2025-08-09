@include('layouts.header')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Select Business Type</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #f7f9fc;
    }

    .header {
      background-color: #021c3d;
      padding: 40px 20px;
      color: white;
      text-align: center;
      font-size: 2rem;
      font-weight: bold;
    }

    .container {
      max-width: 500px;
      margin: auto;
      padding: 20px;
    }

    .title {
      font-size: 1.4rem;
      font-weight: bold;
      color: #222;
      margin-bottom: 8px;
    }

    .subtitle {
      color: #555;
      font-size: 0.95rem;
      margin-bottom: 20px;
    }

    .option {
      display: flex;
      align-items: center;
      border: 2px solid #ddd;
      border-radius: 12px;
      padding: 12px 16px;
      margin-bottom: 12px;
      cursor: pointer;
      background: #fff;
      transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .option:hover {
      border-color: #0056b3;
    }

    .option.selected {
      border-color: #0d9488;
      box-shadow: 0 0 8px rgba(13, 148, 136, 0.3);
    }

    .icon {
      font-size: 1.6rem;
      margin-right: 12px;
      color: #0d9488;
    }

    .option-info {
      display: flex;
      flex-direction: column;
    }

    .option-title {
      font-weight: bold;
      font-size: 30px;
      color: #0A1128;
    }

    .option-desc {
      font-size: 0.85rem;
      color: #666;
    }

    .submit-btn {
      display: block;
      width: 100%;
      margin-top: 20px;
      padding: 12px;
      font-size: 1rem;
      font-weight: bold;
      color: white;
      background-color: #00C853;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .submit-btn:hover {
      background-color: rgb(255, 182, 0);
    }
  </style>
</head>
<body>

<div class="header">
  UMURINZI
</div>

<div class="container">
  <div class="title">One Last Step</div>
  <div class="subtitle">Select your membership type</div>

  <form id="businessForm">
    <div class="option" onclick="selectOption(this)" data-value="BusinessPerson">
      <div class="icon">💼</div>
      <div class="option-info">
        <div class="option-title">BusinessPerson</div>
        <div class="option-desc">Entrepreneurs, Freelancers</div>
      </div>
    </div>

    <div class="option" onclick="selectOption(this)" data-value="Technician">
      <div class="icon">🔧</div>
      <div class="option-info">
        <div class="option-title">Technician</div>
        <div class="option-desc">Electronics, Repair Services</div>
      </div>
    </div>

    <div class="option" onclick="selectOption(this)" data-value="Mechanic">
      <div class="icon">🚗</div>
      <div class="option-info">
        <div class="option-title">Mechanician</div>
        <div class="option-desc">Auto repair, Garage Services</div>
      </div>
    </div>

    <div class="option" onclick="selectOption(this)" data-value="Tailor">
      <div class="icon">🧵</div>
      <div class="option-info">
        <div class="option-title">Tailor</div>
        <div class="option-desc">Clothing & Alterations</div>
      </div>
    </div>

    <div class="option" onclick="selectOption(this)" data-value="Craftsperson">
      <div class="icon">🎨</div>
      <div class="option-info">
        <div class="option-title">Craftsperson</div>
        <div class="option-desc">Woodwork, Handicrafts</div>
      </div>
    </div>

    <div class="option" onclick="selectOption(this)" data-value="Mediator">
      <div class="icon">🤝</div>
      <div class="option-info">
        <div class="option-title">Mediator</div>
        <div class="option-desc">Negotiation, Conflict Resolution</div>
      </div>
    </div>

    <div class="option" onclick="selectOption(this)" data-value="Client">
      <div class="icon">👤</div>
      <div class="option-info">
        <div class="option-title">Client</div>
        <div class="option-desc">Customer looking for services</div>
      </div>
    </div>

    <input type="hidden" name="business_type" id="businessType">

    <button type="submit" class="submit-btn">Continue</button>
  </form>
</div>

<script>
  const routeMap = {
    'BusinessPerson': "{{ route('business.index') }}",
    'Technician': "{{ route('technician.index') }}",
    'Mechanic': "{{ route('mechanic.index') }}",
    'Tailor': "{{ route('tailor.index') }}",
    'Craftsperson': "{{ route('craftperson.index') }}",
    'Mediator': "{{ route('mediator.index') }}",
    'Client': "{{ route('client.index') }}"
  };

  function selectOption(element) {
    document.querySelectorAll('.option').forEach(opt => opt.classList.remove('selected'));
    element.classList.add('selected');
    document.getElementById('businessType').value = element.getAttribute('data-value');
  }

  document.getElementById('businessForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const selected = document.getElementById('businessType').value;
    if (selected && routeMap[selected]) {
      window.location.href = routeMap[selected];
    } else {
      alert('Please select a business type.');
    }
  });
</script>

</body>
</html>
@include('layouts.footer')
