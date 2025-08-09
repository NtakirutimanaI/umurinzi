<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>UMURINZI</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      padding-top: 70px;
      background-color: #0A1128;
      color: white;
    }

    header {
      position: fixed;
      top: 0; left: 0; right: 0;
      background-color: #0A1128;
      border-bottom: 1px solid #eee;
      box-shadow: 0 1px 3px rgba(0,0,0,0.05);
      z-index: 1000;
      height: 70px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 20px;
      flex-wrap: wrap;
    }

    .logo {
      display: flex;
      align-items: center;
      font-weight: bold;
      font-size: 20px;
      color: white;
    }

    .logo img {
      height: 30px;
      margin-right: 8px;
    }

    nav {
      display: flex;
      align-items: center;
      gap: 20px;
      flex-wrap: wrap;
    }

    nav a {
      text-decoration: none;
      color: #ccc;
      font-size: 14px;
      padding-bottom: 5px;
      transition: 0.2s;
    }

    nav a.active {
      border-bottom: 2px solid #fff;
      color: white;
    }

    nav a:hover {
      border-bottom: 2px solid white;
      color: orange;
    }

    .auth-links {
      display: flex;
      gap: 10px;
    }

    .auth-links a {
      padding: 5px 12px;
      border: 1px solid #fff;
      border-radius: 4px;
      font-size: 13px;
      text-decoration: none;
      color: white;
      transition: background 0.3s;
    }

    .auth-links a:hover {
      background-color: #fff;
      color: #0A1128;
    }

    .language-select select {
      background: #1c243a;
      color: white;
      border: 1px solid #444;
      border-radius: 4px;
      padding: 5px 10px;
      font-size: 13px;
    }

    main {
      padding: 20px;
    }

    @media (max-width: 768px) {
      header {
        flex-direction: column;
        align-items: flex-start;
        height: auto;
        gap: 10px;
      }

      .auth-links {
        flex-wrap: wrap;
        margin-top: 10px;
      }
    }
  </style>
</head>
<body>

<header>
  <div class="logo" id="logo-text">
    <img src="{{asset('images/umurinzi.png')}}" alt="UMURINZI Logo">
    UMURINZI
  </div>

  <nav>
    <a href="#" class="active" data-i18n="nav_watch">Watch Guide</a>
    <a href="#" data-i18n="nav_about">About</a>
    <a href="#" data-i18n="nav_support">Support</a>
    <a href="#" data-i18n="nav_support">Products</a>
    <a href="#" data-i18n="nav_support">Team</a>
    <a href="#" data-i18n="nav_support">Contacts</a>
  </nav>

  <div class="auth-links">
    <a href="{{url('register') }}" data-i18n="signup">Sign Up</a>
    <a href="{{ url('login') }}" data-i18n="login">Login</a>
  </div>

  <div class="language-select">
    <select onchange="changeLanguage(this.value)">
      <option value="en">English</option>
      <option value="rw">Kinyarwanda</option>
      <option value="sw">Kiswahili</option>
      <option value="fr">French</option>
    </select>
  </div>
</header>

<script>
  const translations = {
    en: {
      logo: "UMURINZI",
      nav_watch: "Watch Guide",
      nav_about: "About",
      nav_support: "Support",
      signup: "Sign Up",
      login: "Login",
      welcome: "Welcome to UMURINZI",
      description: "Find the best local services in your area fast and reliably.",
      search_placeholder: "What are you looking for?"
    },
    rw: {
      logo: "UMURINZI",
      nav_watch: "Reba Ubuyobozi",
      nav_about: "Ibyerekeye",
      nav_support: "Inkunga",
      signup: "Iyandikishe",
      login: "Injira",
      welcome: "Ikaze kuri UMURINZI",
      description: "Shakisha serivisi zizewe hafi yawe vuba.",
      search_placeholder: "Urimo gushakisha iki?"
    },
    sw: {
      logo: "UMURINZI",
      nav_watch: "Mwongozo wa Kutazama",
      nav_about: "Kuhusu",
      nav_support: "Usaidizi",
      signup: "Jisajili",
      login: "Ingia",
      welcome: "Karibu UMURINZI",
      description: "Tafuta huduma bora karibu nawe kwa haraka na kwa uhakika.",
      search_placeholder: "Unatafuta nini?"
    },
    fr: {
      logo: "UMURINZI",
      nav_watch: "Guide Vidéo",
      nav_about: "À propos",
      nav_support: "Support",
      signup: "S'inscrire",
      login: "Connexion",
      welcome: "Bienvenue sur UMURINZI",
      description: "Trouvez les meilleurs services locaux rapidement et sûrement.",
      search_placeholder: "Que cherchez-vous?"
    }
  };

  function changeLanguage(lang) {
    const elements = document.querySelectorAll('[data-i18n]');
    elements.forEach(el => {
      const key = el.getAttribute('data-i18n');
      if (translations[lang][key]) {
        el.textContent = translations[lang][key];
      }
    });

    const placeholders = document.querySelectorAll('[data-i18n-placeholder]');
    placeholders.forEach(el => {
      const key = el.getAttribute('data-i18n-placeholder');
      if (translations[lang][key]) {
        el.setAttribute('placeholder', translations[lang][key]);
      }
    });

    document.getElementById('logo-text').childNodes[1].textContent = translations[lang].logo;
  }
</script>

</body>
</html>
