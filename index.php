<?php
require 'db.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- ========================================== -->
  <!-- SEO И МЕТА-ТЕГИ                             -->
  <!-- ========================================== -->
      <title>Ваша стоматология — современная клиника | Лечение, имплантация</title>
  <meta name="description" content="Стоматология. Лечение кариеса, имплантация зубов, протезирование, ортодонтия. Опытные врачи, современное оборудование, доступные цены. Онлайн-запись на приём.">
  <meta name="keywords" content="стоматология, стоматолог, имплантация зубов, лечение зубов, протезирование, брекеты">
  <meta name="author" content="Ваша стоматология">
  <meta name="robots" content="index, follow">

  <meta property="og:type" content="website">
  <meta property="og:locale" content="ru_RU">
  <meta property="og:site_name" content="Ваша стоматология">
  <meta property="og:title" content="Ваша стоматология — современная клиника">
  <meta property="og:description" content="Современное оборудование, опытные врачи. Онлайн-запись.">
  <meta property="og:image" content="image/hero.jpg">

  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Ваша стоматология — современная клиника">
  <meta name="twitter:description" content="Современное оборудование, опытные врачи. Онлайн-запись.">
  <meta name="twitter:image" content="image/hero.jpg">>>

  <!-- Open Graph (для соцсетей и мессенджеров) -->
  <meta property="og:type" content="website">
  <meta property="og:locale" content="ru_RU">
  <meta property="og:site_name" content="ВашаСтоматология">
  <meta property="og:title" content="ВашаСтоматология — стоматология в Якутске">
  <meta property="og:description" content="Современное оборудование, врачи высшей категории. Лечим без боли с 2008 года. Онлайн-запись.">
  <meta property="og:image" content="https://eurostom-plus.ru/image/hero.jpg">
  <meta property="og:url" content="https://eurostom-plus.ru/">

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="ВашаСтоматология — стоматология в Якутске">
  <meta name="twitter:description" content="Современное оборудование, врачи высшей категории. Онлайн-запись.">
  <meta name="twitter:image" content="https://eurostom-plus.ru/image/hero.jpg">

  <!-- Favicon -->
  <link rel="icon" href="image/favicon.ico" type="image/x-icon">
  <link rel="apple-touch-icon" href="image/apple-touch-icon.png">

  <!-- Шрифты -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

  <!-- Микроразметка Schema.org (Dentist) -->
    <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Dentist",
    "name": "Стоматология Ваша стоматология",
    "image": "image/hero.jpg",
    "url": "http://localhost/",
    "telephone": "+7-999-123-45-67",
    "email": "info@example.ru",
    "priceRange": "₽₽",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "ул. Ойунского, 24/2",
      "addressLocality": "Якутск",
      "addressRegion": "Республика Саха (Якутия)",
      "postalCode": "677000",
      "addressCountry": "RU"
    },
    "geo": {
      "@type": "GeoCoordinates",
      "latitude": 62.022709,
      "longitude": 129.719925
    },
    "openingHoursSpecification": [
      {
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],
        "opens": "09:00",
        "closes": "19:00"
      }
    ],
    "aggregateRating": {
      "@type": "AggregateRating",
      "ratingValue": "4.4",
      "reviewCount": "17"
    }
  }
  </script>

  <!-- ========================================== -->
  <!-- БЛОК СТИЛЕЙ (CSS)                          -->
  <!-- ========================================== -->
  <style>
    /* --- 1. ПЕРЕМЕННЫЕ (ЦВЕТА И ШРИФТЫ) --- */
    :root {
      --navy: #0B3B5C;
      --navy-dark: #072A42;
      --accent: #2C7DA0;
      --accent-light: #E6F1F7;
      --accent-glow: rgba(44, 125, 160, 0.15);
      --bg: #F5F8FA;
      --white: #FFFFFF;
      --text: #1A2C38;
      --muted: #637A8A;
      --border: #E2EAF0;
      --border-strong: #C9D6E0;
      --success: #4CAF7D;
      --star: #F5B547;
      --error: #E05B5B;
      --radius-sm: 8px;
      --radius: 14px;
      --radius-lg: 20px;
      --shadow-sm: 0 1px 3px rgba(11, 59, 92, 0.06);
      --shadow: 0 4px 20px rgba(11, 59, 92, 0.08);
      --shadow-lg: 0 12px 40px rgba(11, 59, 92, 0.12);
      --ease: cubic-bezier(0.22, 1, 0.36, 1);
      --sans: 'Inter', -apple-system, sans-serif;
      --display: 'Manrope', -apple-system, sans-serif;
    }

    /* --- 2. СБРОС СТИЛЕЙ И БАЗА --- */
    * { margin: 0; padding: 0; box-sizing: border-box; }
    html { scroll-behavior: smooth; scroll-padding-top: 90px; }
    body {
      font-family: var(--sans);
      font-size: 16px;
      line-height: 1.6;
      color: var(--text);
      background: var(--bg);
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
      overflow-x: hidden;
    }
    a { color: inherit; text-decoration: none; }
    img { max-width: 100%; display: block; }
    button { font: inherit; color: inherit; background: none; border: none; cursor: pointer; }

    .container { max-width: 1240px; margin: 0 auto; padding: 0 24px; }

    /* --- 3. ТИПОГРАФИКА --- */
    h1, h2, h3, h4 {
      font-family: var(--display);
      font-weight: 700;
      letter-spacing: -0.025em;
      line-height: 1.15;
      color: var(--navy);
    }
    .eyebrow {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      font-size: 12px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.12em;
      color: var(--accent);
      margin-bottom: 20px;
    }
    .eyebrow::before { content: ''; width: 24px; height: 2px; background: var(--accent); border-radius: 2px; }
    .section-title { font-size: clamp(30px, 3.4vw, 46px); margin-bottom: 16px; max-width: 720px; }
    .section-sub { font-size: 17px; line-height: 1.65; color: var(--muted); max-width: 620px; }

    /* --- 4. КНОПКИ --- */
    .btn {
      display: inline-flex; align-items: center; justify-content: center; gap: 10px;
      padding: 14px 26px; border-radius: 10px; font-family: var(--sans); font-size: 15px;
      font-weight: 600; line-height: 1; transition: all 0.25s var(--ease);
      white-space: nowrap; cursor: pointer;
    }
    .btn--primary { background: var(--navy); color: var(--white); box-shadow: 0 4px 14px rgba(11, 59, 92, 0.2); }
    .btn--primary:hover { background: var(--navy-dark); transform: translateY(-1px); box-shadow: 0 6px 20px rgba(11, 59, 92, 0.28); }
    .btn--accent { background: var(--accent); color: var(--white); box-shadow: 0 4px 14px rgba(44, 125, 160, 0.25); }
    .btn--accent:hover { background: #236B8A; transform: translateY(-1px); box-shadow: 0 6px 20px rgba(44, 125, 160, 0.32); }
    .btn--ghost { background: transparent; color: var(--navy); border: 1.5px solid var(--border-strong); }
    .btn--ghost:hover { border-color: var(--navy); background: var(--white); }
    .btn--white { background: var(--white); color: var(--navy); }
    .btn--white:hover { background: var(--accent-light); }
    .btn svg { transition: transform 0.25s var(--ease); }
    .btn:hover svg { transform: translateX(3px); }
    .btn:disabled { opacity: 0.6; cursor: not-allowed; transform: none; }

    /* --- 5. ПРОГРЕСС-БАР --- */
    .progress { position: fixed; top: 0; left: 0; height: 2px; width: 0; background: var(--accent); z-index: 200; transition: width 0.1s linear; }

    /* --- 6. ШАПКА САЙТА --- */
    .header {
      position: fixed; top: 0; left: 0; right: 0; z-index: 100;
      background: rgba(245, 248, 250, 0.85); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px);
      border-bottom: 1px solid transparent; transition: all 0.3s var(--ease);
    }
    .header.is-scrolled { background: rgba(255, 255, 255, 0.95); border-bottom-color: var(--border); box-shadow: 0 1px 8px rgba(11, 59, 92, 0.04); }
    .header__inner { display: flex; align-items: center; justify-content: space-between; gap: 32px; height: 76px; }

    .logo { display: flex; align-items: center; gap: 10px; font-family: var(--display); font-weight: 800; font-size: 20px; color: var(--navy); letter-spacing: -0.02em; flex-shrink: 0; }
    .logo__mark { width: 38px; height: 38px; border-radius: 10px; background: var(--navy); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .logo__mark svg { width: 20px; height: 20px; }
    .logo span em { font-style: normal; color: var(--accent); }

    .nav { display: flex; gap: 28px; flex: 1; justify-content: center; }
    .nav a { font-size: 14.5px; font-weight: 500; color: var(--muted); position: relative; padding: 6px 0; transition: color 0.2s; }
    .nav a::after { content: ''; position: absolute; left: 0; right: 0; bottom: 0; height: 2px; background: var(--accent); border-radius: 2px; transform: scaleX(0); transform-origin: left; transition: transform 0.3s var(--ease); }
    .nav a:hover { color: var(--navy); }
    .nav a:hover::after { transform: scaleX(1); }

    .header__actions { display: flex; align-items: center; gap: 16px; flex-shrink: 0; }
    .header__phone { font-family: var(--display); font-weight: 700; font-size: 16px; color: var(--navy); letter-spacing: -0.01em; transition: color 0.2s; }
    .header__phone:hover { color: var(--accent); }

    .burger { display: none; width: 42px; height: 42px; flex-direction: column; align-items: center; justify-content: center; gap: 5px; border-radius: 8px; transition: background 0.2s; }
    .burger:hover { background: var(--accent-light); }
    .burger span { width: 22px; height: 2px; background: var(--navy); border-radius: 2px; transition: all 0.3s var(--ease); }
    .burger.is-open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
    .burger.is-open span:nth-child(2) { opacity: 0; }
    .burger.is-open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

    /* --- 7. МОБИЛЬНОЕ МЕНЮ --- */
    .menu { position: fixed; top: 76px; left: 0; right: 0; background: var(--white); border-bottom: 1px solid var(--border); padding: 24px; transform: translateY(-100%); opacity: 0; visibility: hidden; transition: all 0.4s var(--ease); z-index: 99; box-shadow: var(--shadow-lg); }
    .menu.is-open { transform: translateY(0); opacity: 1; visibility: visible; }
    .menu nav { display: flex; flex-direction: column; gap: 4px; margin-bottom: 20px; }
    .menu nav a { font-family: var(--display); font-weight: 600; font-size: 20px; color: var(--navy); padding: 14px 12px; border-radius: 10px; transition: background 0.2s; }
    .menu nav a:hover { background: var(--accent-light); }
    .menu__actions { display: flex; flex-direction: column; gap: 10px; padding-top: 20px; border-top: 1px solid var(--border); }
    .menu__actions .btn { width: 100%; }

    /* --- 8. ГЛАВНЫЙ ЭКРАН --- */
    .hero { padding: 140px 0 60px; position: relative; background: linear-gradient(180deg, var(--bg) 0%, #EEF4F8 100%); overflow: hidden; }
    .hero::before { content: ''; position: absolute; top: -200px; right: -100px; width: 700px; height: 700px; background: radial-gradient(circle, rgba(44, 125, 160, 0.10) 0%, transparent 70%); border-radius: 50%; pointer-events: none; }
    .hero__grid { display: grid; grid-template-columns: 1.05fr 1fr; gap: 64px; align-items: center; position: relative; z-index: 1; }
    .hero__badge { display: inline-flex; align-items: center; gap: 10px; background: var(--white); border: 1px solid var(--border); padding: 8px 16px; border-radius: 100px; font-size: 13px; font-weight: 600; color: var(--navy); margin-bottom: 28px; box-shadow: var(--shadow-sm); }
    .hero__badge .dot { width: 8px; height: 8px; border-radius: 50%; background: var(--success); box-shadow: 0 0 0 3px rgba(76, 175, 125, 0.2); animation: pulse 2s infinite; }
    @keyframes pulse { 0%, 100% { box-shadow: 0 0 0 3px rgba(76, 175, 125, 0.2); } 50% { box-shadow: 0 0 0 6px rgba(76, 175, 125, 0.05); } }
    .hero h1 { font-size: clamp(38px, 5.2vw, 62px); line-height: 1.05; letter-spacing: -0.03em; margin-bottom: 24px; }
    .hero h1 .accent { color: var(--accent); position: relative; display: inline-block; }
    .hero h1 .accent::after { content: ''; position: absolute; left: 0; right: 0; bottom: 4px; height: 10px; background: var(--accent-glow); border-radius: 2px; z-index: -1; }
    .hero__lead { font-size: 18px; line-height: 1.65; color: var(--muted); max-width: 500px; margin-bottom: 36px; }
    .hero__actions { display: flex; gap: 14px; margin-bottom: 0; flex-wrap: wrap; }

    .hero__visual { position: relative; }
    .hero__image { position: relative; aspect-ratio: 4/4.6; border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--shadow-lg); background: var(--accent-light); }
    .hero__image img { width: 100%; height: 100%; object-fit: cover; transform: scale(1.03); transition: transform 1.2s var(--ease); }
    .hero__image:hover img { transform: scale(1); }
    .hero__card { position: absolute; background: var(--white); border-radius: var(--radius); padding: 16px 20px; box-shadow: var(--shadow-lg); display: flex; align-items: center; gap: 12px; animation: float 4s ease-in-out infinite; }
    .hero__card--rating { top: 24px; left: -20px; }
    .hero__card--patients { bottom: 24px; right: -20px; animation-delay: 1s; }
    @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-8px); } }
    .hero__card-icon { width: 40px; height: 40px; border-radius: 10px; background: var(--accent-light); display: flex; align-items: center; justify-content: center; flex-shrink: 0; color: var(--accent); }
    .hero__card-value { font-family: var(--display); font-weight: 800; font-size: 20px; color: var(--navy); line-height: 1; }
    .hero__card-label { font-size: 12px; color: var(--muted); margin-top: 3px; }

    /* --- 9. СТАТИСТИКА --- */
    .stats-band { background: var(--white); border-bottom: 1px solid var(--border); padding: 48px 0; }
    .stats-band__grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; }
    .stats-band__item { display: flex; flex-direction: column; align-items: center; text-align: center; padding: 0 20px; border-right: 1px solid var(--border); }
    .stats-band__item:last-child { border-right: none; }
    .stats-band__num { font-family: var(--display); font-weight: 800; font-size: 42px; color: var(--navy); line-height: 1; letter-spacing: -0.03em; display: flex; align-items: flex-start; gap: 4px; }
    .stats-band__num .star { font-size: 20px; color: var(--star); line-height: 1; margin-top: 4px; }
    .stats-band__label { font-size: 14px; color: var(--muted); font-weight: 500; margin-top: 8px; }

    /* --- 10. ПОЛОСКА ПРЕИМУЩЕСТВ --- */
    .strip { background: var(--navy); color: var(--white); padding: 28px 0; }
    .strip__grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 32px; }
    .strip__item { display: flex; align-items: center; gap: 14px; }
    .strip__item svg { flex-shrink: 0; opacity: 0.9; }
    .strip__text { font-size: 14px; font-weight: 500; line-height: 1.4; color: rgba(255, 255, 255, 0.9); }

    /* --- 11. ОБЩИЕ СЕКЦИИ --- */
    .section { padding: 100px 0; }
    .section--white { background: var(--white); }
    .section__head { text-align: center; max-width: 780px; margin: 0 auto 56px; }
    .section__head .section-title, .section__head .section-sub { margin-left: auto; margin-right: auto; }
    .section__head .eyebrow { justify-content: center; }

    /* --- 12. ПРЕИМУЩЕСТВА --- */
    .features { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
    .feature { background: var(--white); padding: 32px 28px; border-radius: var(--radius-lg); border: 1px solid var(--border); transition: all 0.3s var(--ease); }
    .feature:hover { border-color: transparent; box-shadow: var(--shadow-lg); transform: translateY(-4px); }
    .feature__icon { width: 48px; height: 48px; border-radius: 12px; background: var(--accent-light); color: var(--accent); display: flex; align-items: center; justify-content: center; margin-bottom: 20px; }
    .feature h3 { font-size: 18px; font-weight: 700; margin-bottom: 8px; }
    .feature p { font-size: 14.5px; line-height: 1.6; color: var(--muted); }

    /* --- 13. УСЛУГИ --- */
    .services { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
    .service { background: var(--bg); border-radius: var(--radius-lg); padding: 32px 28px; display: flex; flex-direction: column; transition: all 0.3s var(--ease); border: 1px solid transparent; position: relative; overflow: hidden; }
    .service::after { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px; background: var(--accent); transform: scaleX(0); transform-origin: left; transition: transform 0.4s var(--ease); }
    .service:hover { background: var(--white); border-color: var(--border); box-shadow: var(--shadow-lg); transform: translateY(-4px); }
    .service:hover::after { transform: scaleX(1); }
    .service__num { font-family: var(--display); font-size: 13px; font-weight: 700; color: var(--accent); letter-spacing: 0.04em; margin-bottom: 16px; }
    .service h3 { font-size: 21px; font-weight: 700; margin-bottom: 10px; letter-spacing: -0.015em; }
    .service p { font-size: 14.5px; line-height: 1.6; color: var(--muted); margin-bottom: 24px; flex: 1; }
    .service__price { display: flex; align-items: baseline; gap: 6px; padding-top: 20px; border-top: 1px solid var(--border); margin-bottom: 16px; }
    .service__price-label { font-size: 13px; color: var(--muted); }
    .service__price-value { font-family: var(--display); font-weight: 700; font-size: 18px; color: var(--navy); }
    .service__link { display: inline-flex; align-items: center; gap: 6px; font-size: 14px; font-weight: 600; color: var(--accent); transition: gap 0.2s; }
    .service__link:hover { gap: 10px; }

    /* --- 14. ВРАЧИ --- */
    .doctors { display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; }
    .doctor { background: var(--white); border-radius: var(--radius-lg); overflow: hidden; border: 1px solid var(--border); transition: all 0.3s var(--ease); display: flex; flex-direction: column; }
    .doctor:hover { transform: translateY(-4px); box-shadow: var(--shadow-lg); border-color: transparent; }
    .doctor__photo { aspect-ratio: 1/1.1; background: var(--bg); overflow: hidden; position: relative; }
    .doctor__photo img { width: 100%; height: 100%; object-fit: cover; object-position: top center; transition: transform 0.6s var(--ease); }
    .doctor:hover .doctor__photo img { transform: scale(1.05); }
    /* Заглушка на случай, если фото не загрузилось */
    .doctor__photo.no-photo::after { content: 'Фото скоро появится'; position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; text-align: center; padding: 20px; font-size: 13px; color: var(--muted); background: var(--accent-light); }
    .doctor__badge { position: absolute; top: 12px; left: 12px; background: var(--white); color: var(--navy); padding: 5px 10px; border-radius: 6px; font-size: 11px; font-weight: 700; letter-spacing: 0.04em; text-transform: uppercase; box-shadow: 0 2px 8px rgba(0,0,0,0.1); z-index: 2; }
    .doctor__body { padding: 24px 20px; display: flex; flex-direction: column; flex: 1; }
    .doctor__name { font-family: var(--display); font-size: 18px; font-weight: 700; color: var(--navy); line-height: 1.3; margin-bottom: 8px; }
    .doctor__role { font-size: 13px; font-weight: 600; color: var(--accent); margin-bottom: 8px; }
    .doctor__meta { font-size: 13.5px; color: var(--muted); line-height: 1.5; margin-top: auto; }

    /* --- 15. ЦЕНЫ --- */
    .prices-wrap { background: var(--white); border-radius: var(--radius-lg); border: 1px solid var(--border); overflow: hidden; box-shadow: var(--shadow-sm); }
    .price-row { display: grid; grid-template-columns: 1fr auto; gap: 24px; align-items: center; padding: 20px 32px; border-bottom: 1px solid var(--border); transition: background 0.2s; }
    .price-row:last-child { border-bottom: none; }
    .price-row:hover { background: var(--bg); }
    .price-row__name { font-size: 15.5px; font-weight: 500; color: var(--text); }
    .price-row__value { font-family: var(--display); font-size: 17px; font-weight: 700; color: var(--navy); white-space: nowrap; }
    .price-note { margin-top: 24px; font-size: 13px; color: var(--muted); text-align: center; }

    /* --- 16. ОТЗЫВЫ --- */
    .reviews { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
    .review { background: var(--white); border-radius: var(--radius-lg); padding: 28px; border: 1px solid var(--border); display: flex; flex-direction: column; transition: all 0.3s var(--ease); }
    .review:hover { transform: translateY(-4px); box-shadow: var(--shadow-lg); border-color: transparent; }
    .review__head { display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; }
    .review__stars { display: flex; gap: 2px; color: var(--star); }
    .review__source { font-size: 11px; font-weight: 600; color: var(--muted); text-transform: uppercase; letter-spacing: 0.06em; }
    .review__text { font-size: 15px; line-height: 1.65; color: var(--text); margin-bottom: 20px; flex: 1; }
    .review__author { display: flex; align-items: center; gap: 12px; padding-top: 16px; border-top: 1px solid var(--border); }
    .review__avatar { width: 40px; height: 40px; border-radius: 50%; background: var(--accent-light); color: var(--accent); display: flex; align-items: center; justify-content: center; font-family: var(--display); font-weight: 700; font-size: 15px; flex-shrink: 0; }
    .review__name { font-size: 14px; font-weight: 600; color: var(--navy); }
    .review__date { font-size: 12px; color: var(--muted); margin-top: 2px; }

    /* --- 17. CTA --- */
    .cta { background: linear-gradient(135deg, var(--navy) 0%, var(--accent) 120%); border-radius: var(--radius-lg); padding: 64px 56px; display: grid; grid-template-columns: 1.4fr 1fr; gap: 40px; align-items: center; color: var(--white); position: relative; overflow: hidden; }
    .cta::before { content: ''; position: absolute; top: -100px; right: -100px; width: 400px; height: 400px; background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, transparent 70%); border-radius: 50%; pointer-events: none; }
    .cta__content { position: relative; z-index: 1; }
    .cta h2 { font-size: clamp(26px, 3vw, 38px); color: var(--white); margin-bottom: 14px; }
    .cta p { font-size: 16px; line-height: 1.6; color: rgba(255, 255, 255, 0.8); max-width: 460px; }
    .cta__actions { display: flex; gap: 12px; flex-wrap: wrap; position: relative; z-index: 1; justify-content: flex-end; }

    /* --- 18. КОНТАКТЫ И ФОРМА --- */
    .contacts { display: grid; grid-template-columns: 1fr 1fr; gap: 48px; align-items: stretch; }
    .contacts__info { display: flex; flex-direction: column; gap: 8px; }
    .contact-card { display: flex; gap: 16px; padding: 20px 22px; background: var(--white); border-radius: var(--radius); border: 1px solid var(--border); transition: all 0.2s; align-items: flex-start; }
    .contact-card:hover { border-color: var(--accent); box-shadow: var(--shadow); }
    .contact-card__icon { width: 40px; height: 40px; flex-shrink: 0; border-radius: 10px; background: var(--accent-light); color: var(--accent); display: flex; align-items: center; justify-content: center; }
    .contact-card__label { font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.06em; color: var(--muted); margin-bottom: 4px; }
    .contact-card__value { font-family: var(--display); font-size: 15.5px; font-weight: 600; color: var(--navy); line-height: 1.45; }
    .contact-card__value a { transition: color 0.2s; }
    .contact-card__value a:hover { color: var(--accent); }

    .booking-form { background: var(--white); padding: 40px; border-radius: var(--radius-lg); border: 1px solid var(--border); box-shadow: var(--shadow-lg); display: flex; flex-direction: column; }
    .booking-form h3 { font-size: 24px; margin-bottom: 8px; }
    .booking-form > p { font-size: 14px; color: var(--muted); margin-bottom: 24px; }
    .form-group { margin-bottom: 16px; }
    .form-label { display: block; font-size: 13px; font-weight: 600; color: var(--text); margin-bottom: 6px; }
    .form-input { width: 100%; padding: 14px 16px; border: 1.5px solid var(--border); border-radius: 8px; font-family: var(--sans); font-size: 15px; color: var(--text); transition: all 0.2s; background: var(--bg); }
    .form-input::placeholder { color: #9AAAB5; }
    .form-input:focus { outline: none; border-color: var(--accent); background: var(--white); box-shadow: 0 0 0 4px var(--accent-glow); }
    .form-input.is-invalid { border-color: var(--error); background: #FFF8F8; }
    .form-input.is-invalid:focus { box-shadow: 0 0 0 4px rgba(224, 91, 91, 0.1); }
    .form-error { display: none; font-size: 12px; color: var(--error); margin-top: 6px; font-weight: 500; }
    .form-error.is-visible { display: block; }
    select.form-input { appearance: none; background-image: url("data:image/svg+xml,%3Csvg width='12' height='8' viewBox='0 0 12 8' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 1.5L6 6.5L11 1.5' stroke='%23637A8A' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 16px center; padding-right: 40px; }
    .form-checkbox { display: flex; align-items: flex-start; gap: 10px; margin-bottom: 24px; cursor: pointer; }
    .form-checkbox input { margin-top: 4px; width: 16px; height: 16px; accent-color: var(--accent); flex-shrink: 0; }
    .form-checkbox span { font-size: 12px; line-height: 1.4; color: var(--muted); }
    .form-checkbox a { color: var(--accent); text-decoration: underline; }
    .form-checkbox.is-invalid span { color: var(--error); }
    .booking-form .btn { width: 100%; padding: 16px; font-size: 16px; }
    .form-success { display: none; background: #EBF9F1; border: 1px solid #C4EBD3; color: #2E7D50; padding: 16px; border-radius: 8px; font-size: 14px; line-height: 1.5; margin-top: 16px; font-weight: 500; text-align: center; }
    .form-success.is-visible { display: block; }
    .form-error-global { display: none; background: #FDF0F0; border: 1px solid #F5C6C6; color: #B33A3A; padding: 14px; border-radius: 8px; font-size: 14px; line-height: 1.5; margin-top: 16px; font-weight: 500; text-align: center; }
    .form-error-global.is-visible { display: block; }

    .contacts__map { border-radius: var(--radius-lg); overflow: hidden; border: 1px solid var(--border); box-shadow: var(--shadow-sm); min-height: 400px; background: var(--accent-light); position: relative; margin-top: 48px; }
    .contacts__map iframe { width: 100%; height: 100%; border: none; display: block; position: absolute; inset: 0; }

    /* --- 19. ФУТЕР --- */
    .footer { background: var(--navy-dark); color: rgba(255, 255, 255, 0.7); padding: 64px 0 32px; margin-top: 100px; font-size: 14px; }
    .footer__grid { display: grid; grid-template-columns: 1.5fr 1fr 1fr 1fr; gap: 48px; padding-bottom: 48px; border-bottom: 1px solid rgba(255, 255, 255, 0.1); }
    .footer .logo { color: var(--white); }
    .footer .logo__mark { background: var(--accent); }
    .footer__about { margin-top: 20px; line-height: 1.65; font-size: 14px; color: rgba(255, 255, 255, 0.6); max-width: 320px; }
    .footer h4 { font-family: var(--display); font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: var(--white); margin-bottom: 20px; }
    .footer ul { list-style: none; display: flex; flex-direction: column; gap: 12px; }
    .footer ul a { font-size: 14px; color: rgba(255, 255, 255, 0.65); transition: color 0.2s; }
    .footer ul a:hover { color: var(--white); }
    .footer__bottom { display: flex; justify-content: space-between; flex-wrap: wrap; gap: 16px; padding-top: 32px; font-size: 13px; color: rgba(255, 255, 255, 0.45); }
    .footer__socials { display: flex; gap: 10px; margin-top: 20px; }
    .footer__socials a { width: 38px; height: 38px; border-radius: 10px; background: rgba(255,255,255,0.08); display: flex; align-items: center; justify-content: center; transition: background 0.2s; }
    .footer__socials a:hover { background: var(--accent); }

    /* --- 20. МОБИЛЬНАЯ ПАНЕЛЬ --- */
    .mobile-bar { display: none; position: fixed; bottom: 0; left: 0; right: 0; background: var(--white); padding: 10px 12px; padding-bottom: calc(10px + env(safe-area-inset-bottom)); gap: 10px; box-shadow: 0 -4px 20px rgba(11, 59, 92, 0.1); z-index: 90; border-top: 1px solid var(--border); }
    .mobile-bar .btn { flex: 1; padding: 14px 12px; font-size: 14px; }

    /* --- 21. ПЛАВАЮЩАЯ КНОПКА WHATSAPP --- */
    .fab-wa {
      position: fixed; right: 22px; bottom: 90px; z-index: 95;
      width: 56px; height: 56px; border-radius: 50%;
      background: #25D366; color: #fff;
      display: flex; align-items: center; justify-content: center;
      box-shadow: 0 8px 24px rgba(37, 211, 102, 0.45);
      transition: transform 0.25s var(--ease), box-shadow 0.25s var(--ease);
    }
    .fab-wa:hover { transform: scale(1.08); box-shadow: 0 12px 30px rgba(37, 211, 102, 0.55); }
    .fab-wa svg { width: 30px; height: 30px; }
    @media (max-width: 860px) { .fab-wa { bottom: 86px; right: 14px; width: 50px; height: 50px; } }

    /* --- 22. АНИМАЦИИ ПРИ СКРОЛЛЕ --- */
    [data-reveal] { opacity: 0; transform: translateY(30px); transition: opacity 0.8s var(--ease), transform 0.8s var(--ease); transition-delay: var(--delay, 0ms); }
    [data-reveal].in { opacity: 1; transform: translateY(0); }

    /* --- 23. АДАПТИВ --- */
    @media (max-width: 1024px) {
      .nav { gap: 20px; }
      .nav a { font-size: 14px; }
      .hero { padding: 120px 0 60px; }
      .hero__grid { gap: 40px; }
      .hero__card--rating { left: 10px; top: 16px; }
      .hero__card--patients { right: 10px; bottom: 16px; }
      .doctors { grid-template-columns: repeat(3, 1fr); }
      .features, .services, .reviews { grid-template-columns: repeat(2, 1fr); }
      .strip__grid { grid-template-columns: repeat(2, 1fr); gap: 20px; }
      .cta { padding: 48px 40px; }
      .footer__grid { grid-template-columns: 1fr 1fr; gap: 32px; }
      .contacts { grid-template-columns: 1fr; }
    }

    @media (max-width: 860px) {
      .nav, .header__actions .header__phone, .header__actions .btn { display: none; }
      .burger { display: flex; }
      .hero__grid { grid-template-columns: 1fr; gap: 40px; }
      .hero__visual { max-width: 480px; margin: 0 auto; width: 100%; }
      .hero__image { aspect-ratio: 1/1; }
      .stats-band__grid { grid-template-columns: repeat(2, 1fr); gap: 32px; }
      .stats-band__item:nth-child(2) { border-right: none; }
      .stats-band__item { border-right: 1px solid var(--border); }
      .stats-band__item:nth-child(odd) { border-right: 1px solid var(--border); }
      .stats-band__item:last-child { border-right: none; }
      .contacts__map { min-height: 360px; }
      .cta { grid-template-columns: 1fr; text-align: left; padding: 40px 28px; }
      .cta__actions { justify-content: flex-start; }
      .mobile-bar { display: flex; }
      body { padding-bottom: 76px; }
      .section { padding: 72px 0; }
      .footer { margin-top: 72px; padding: 48px 0 24px; }
      .doctors { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 600px) {
      .container { padding: 0 18px; }
      .hero { padding: 100px 0 48px; }
      .hero h1 { font-size: 36px; }
      .hero__lead { font-size: 16px; }
      .hero__actions { flex-direction: column; align-items: stretch; }
      .hero__actions .btn { width: 100%; }
      .hero__card { padding: 12px 14px; }
      .hero__card-icon { width: 34px; height: 34px; }
      .hero__card-value { font-size: 16px; }
      .hero__card-label { font-size: 11px; }
      .hero__card--rating { left: 8px; top: 8px; }
      .hero__card--patients { right: 8px; bottom: 8px; }
      .stats-band__num { font-size: 32px; }
      .stats-band__label { font-size: 13px; }
      .features, .services, .reviews, .doctors { grid-template-columns: 1fr; }
      .section__head { margin-bottom: 40px; }
      .section-title { font-size: 28px; }
      .section-sub { font-size: 15px; }
      .strip { padding: 20px 0; }
      .strip__grid { grid-template-columns: 1fr; gap: 16px; }
      .strip__item { justify-content: flex-start; }
      .price-row { padding: 16px 20px; gap: 12px; }
      .price-row__name { font-size: 14px; }
      .price-row__value { font-size: 15px; }
      .footer__grid { grid-template-columns: 1fr; gap: 28px; }
      .footer__bottom { flex-direction: column; align-items: flex-start; gap: 8px; }
      .service { padding: 26px 22px; }
      .feature { padding: 26px 22px; }
      .review { padding: 24px; }
      .cta h2 { font-size: 24px; }
      .cta { padding: 32px 22px; }
      .booking-form { padding: 24px; }
      .contacts__map { margin-top: 24px; }
    }

    @media (prefers-reduced-motion: reduce) {
      *, *::before, *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
        scroll-behavior: auto !important;
      }
    }
    /* --- ПЛАШКА COOKIE --- */
    .cookie-banner {
      position: fixed;
      bottom: 20px;
      left: 20px;
      right: 20px;
      max-width: 600px;
      margin: 0 auto;
      background: var(--white);
      padding: 16px 24px;
      border-radius: 12px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.15);
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 20px;
      z-index: 9999;
      transform: translateY(150%);
      transition: transform 0.4s ease;
      border: 1px solid var(--border);
    }
    .cookie-banner.is-visible {
      transform: translateY(0);
    }
    .cookie-banner__text {
      font-size: 13px;
      color: var(--text);
      line-height: 1.4;
    }
    .cookie-banner__text a {
      color: var(--accent);
      text-decoration: underline;
    }
    .cookie-banner__btn {
      background: var(--navy);
      color: var(--white);
      border: none;
      padding: 10px 20px;
      border-radius: 8px;
      font-weight: 600;
      font-size: 13px;
      cursor: pointer;
      white-space: nowrap;
      transition: background 0.2s;
    }
    .cookie-banner__btn:hover {
      background: var(--accent);
    }

    @media (max-width: 600px) {
      .cookie-banner {
        flex-direction: column;
        text-align: center;
        bottom: 76px;
        padding: 16px;
        gap: 12px;
      }
      .cookie-banner__btn {
        width: 100%;
      }
    }
  </style>
</head>
<body>

<!-- ========================================== -->
<!-- ПОЛОСКА ПРОГРЕССА                          -->
<!-- ========================================== -->
<div class="progress" id="progress"></div>

<!-- ========================================== -->
<!-- 1. ШАПКА САЙТА                             -->
<!-- ========================================== -->
<header class="header" id="header">
  <div class="container">
    <div class="header__inner">
        <a href="#" class="logo">
        <span class="logo__mark">
          <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M12 3C8 3 5 5.5 5 9c0 2.5 1 4 1 6 0 3 1 6 2.5 6 1.5 0 1.2-3 3.5-3s2 3 3.5 3c1.5 0 2.5-3 2.5-6 0-2 1-3.5 1-6 0-3.5-3-6-7-6z" fill="#fff"/>
          </svg>
        </span>
        <span>Ваша<em>Стоматология</em></span>
      </a>

            <nav class="nav" aria-label="Основная навигация">
        <a href="#services">Услуги</a>
        <a href="#doctors">Врачи</a>
        <a href="#news">Новости</a> <!-- ВОТ ЭТА СТРОКА -->
        <a href="#prices">Цены</a>
        <a href="#reviews">Отзывы</a>
        <a href="#contacts">Контакты</a>
      </nav>

      <div class="header__actions">
               <a href="tel:+79991234567" class="header__phone">+7 (999) 123-45-67</a>
        <a href="#booking" class="btn btn--primary">Записаться</a>
      </div>

      <button class="burger" id="burger" aria-label="Открыть меню" aria-expanded="false" aria-controls="menu">
        <span></span><span></span><span></span>
      </button>
    </div>
  </div>
</header>

<!-- ========================================== -->
<!-- 2. МОБИЛЬНОЕ МЕНЮ                          -->
<!-- ========================================== -->
<div class="menu" id="menu">
  <nav aria-label="Мобильная навигация">
    <a href="#services">Услуги</a>
    <a href="#doctors">Врачи</a>
    <a href="#prices">Цены</a>
    <a href="#reviews">Отзывы</a>
    <a href="#contacts">Контакты</a>
  </nav>
  <div class="menu__actions">
    <a href="tel:+79247600094" class="btn btn--ghost">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
        <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.13.96.36 1.9.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0122 16.92z" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
      Позвонить
    </a>
    <a href="#booking" class="btn btn--primary">Записаться на приём</a>
  </div>
</div>

<!-- ========================================== -->
<!-- 3. ГЛАВНЫЙ ЭКРАН (HERO)                    -->
<!-- ========================================== -->
<section class="hero" id="home">
  <div class="container">
    <div class="hero__grid">
      <div class="hero__content">
        <div class="hero__badge">
          <span class="dot"></span>
          Принимаем новых пациентов
        </div>
        <h1>
          Стоматология<br>в Якутске, которой<br><span class="accent">доверяют семьи</span>
        </h1>
        <p class="hero__lead">
          Современное оборудование, врачи высшей категории и внимательное отношение к каждому пациенту. Лечим без боли и страха — с 2008 года.
        </p>
        <div class="hero__actions">
          <a href="#booking" class="btn btn--primary">
            Записаться на консультацию
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
              <path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </a>
          <a href="#services" class="btn btn--ghost">Наши услуги</a>
        </div>
      </div>

            <div class="hero__visual">
        <div class="hero__image" style="display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #E6F1F7, #C9D6E0);">
            <span style="color: #637A8A; font-weight: 600; font-size: 16px; text-align: center; padding: 20px;">Здесь будет фото<br>вашей клиники</span>
        </div>

        <div class="hero__card hero__card--rating">
          <div class="hero__card-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
          </div>
          <div>
            <div class="hero__card-value">4.4 из 5</div>
            <div class="hero__card-label">17 отзывов на Яндекс.Картах</div>
          </div>
        </div>

        <div class="hero__card hero__card--patients">
          <div class="hero__card-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true">
              <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2M9 11a4 4 0 100-8 4 4 0 000 8zM23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
          <div>
            <div class="hero__card-value">12 000+</div>
            <div class="hero__card-label">пациентов прошли лечение</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ========================================== -->
<!-- 4. СТАТИСТИКА                              -->
<!-- ========================================== -->
<section class="stats-band">
  <div class="container">
    <div class="stats-band__grid" data-reveal>
      <div class="stats-band__item">
        <div class="stats-band__num">15+</div>
        <div class="stats-band__label">лет опыта</div>
      </div>
      <div class="stats-band__item">
        <div class="stats-band__num">11</div>
        <div class="stats-band__label">врачей в команде</div>
      </div>
      <div class="stats-band__item">
        <div class="stats-band__num">12 000+</div>
        <div class="stats-band__label">пациентов</div>
      </div>
      <div class="stats-band__item">
        <div class="stats-band__num">4.4<span class="star">★</span></div>
        <div class="stats-band__label">рейтинг на Яндексе</div>
      </div>
    </div>
  </div>
</section>

<!-- ========================================== -->
<!-- 5. ПОЛОСКА ПРЕИМУЩЕСТВ                     -->
<!-- ========================================== -->
<div class="strip">
  <div class="container">
    <div class="strip__grid">
      <div class="strip__item">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#4CAF7D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
          <polyline points="9 12 11 14 15 10"/>
        </svg>
        <div class="strip__text">Лицензированная<br>медицинская помощь</div>
      </div>
      <div class="strip__item">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#4ECDC4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <path d="M9 11l3 3L22 4"/>
          <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/>
        </svg>
        <div class="strip__text">Одноразовые<br>расходные материалы</div>
      </div>
      <div class="strip__item">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#F5B547" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <circle cx="12" cy="12" r="10"/>
          <polyline points="12 6 12 12 16 14"/>
        </svg>
        <div class="strip__text">Прозрачные цены<br>без скрытых доплат</div>
      </div>
      <div class="strip__item">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#E6F1F7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
          <circle cx="12" cy="7" r="4"/>
        </svg>
        <div class="strip__text">Врачи высшей<br>категории и к.м.н.</div>
      </div>
    </div>
  </div>
</div>

<!-- ========================================== -->
<!-- 6. ПРЕИМУЩЕСТВА                            -->
<!-- ========================================== -->
<section class="section">
  <div class="container">
    <div class="section__head" data-reveal>
      <div class="eyebrow">Почему ВашаСтоматология</div>
      <h2 class="section-title">Заботимся о пациентах с первого визита</h2>
      <p class="section-sub">Современное оборудование, опытные специалисты и комфортная атмосфера — без страха и лишних переживаний.</p>
    </div>
    <div class="features">
      <div class="feature" data-reveal>
        <div class="feature__icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
          </svg>
        </div>
        <h3>Безопасность и стерильность</h3>
        <p>Многоступенчатая стерилизация инструментов, одноразовые расходники и строгие протоколы обработки.</p>
      </div>
      <div class="feature" data-reveal style="--delay: 80ms">
        <div class="feature__icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <circle cx="12" cy="12" r="10"/>
            <path d="M12 6v6l4 2"/>
          </svg>
        </div>
        <h3>Лечение без боли</h3>
        <p>Современная анестезия и бережное отношение к пациентам, которые боятся стоматологов.</p>
      </div>
      <div class="feature" data-reveal style="--delay: 160ms">
        <div class="feature__icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M20 12V8H6a2 2 0 010-4h12v4M4 6v12a2 2 0 002 2h14v-4"/>
            <path d="M18 12a2 2 0 000 4h4v-4z"/>
          </svg>
        </div>
        <h3>Прозрачные цены</h3>
        <p>Стоимость лечения обсуждаем до его начала. Никаких скрытых доплат и неожиданных счетов.</p>
      </div>
      <div class="feature" data-reveal style="--delay: 240ms">
        <div class="feature__icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"/>
            <circle cx="9" cy="7" r="4"/>
            <path d="M22 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
          </svg>
        </div>
        <h3>Команда специалистов</h3>
        <p>Врачи высшей категории, кандидаты медицинских наук и постоянное повышение квалификации.</p>
      </div>
      <div class="feature" data-reveal style="--delay: 320ms">
        <div class="feature__icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/>
            <circle cx="12" cy="10" r="3"/>
          </svg>
        </div>
        <h3>4 филиала в Якутске</h3>
        <p>Удобно добираться из любого района города — выберите ближайший к дому или работе.</p>
      </div>
      <div class="feature" data-reveal style="--delay: 400ms">
        <div class="feature__icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
            <polyline points="14 2 14 8 20 8"/>
            <line x1="9" y1="15" x2="15" y2="15"/>
          </svg>
        </div>
        <h3>Индивидуальный план</h3>
        <p>Составляем план лечения под ваш случай и финансовые возможности, с приоритетами.</p>
      </div>
    </div>
  </div>
</section>

<!-- ========================================== -->
<!-- 7. УСЛУГИ                                  -->
<!-- ========================================== -->
<section class="section section--white" id="services">
  <div class="container">
    <div class="section__head" data-reveal>
      <div class="eyebrow">Наши услуги</div>
      <h2 class="section-title">Полный спектр стоматологической помощи</h2>
      <p class="section-sub">От профилактической гигиены до сложной имплантации — всё в одной клинике.</p>
    </div>
    <div class="services">
      <div class="service" data-reveal>
        <div class="service__num">01 / Терапия</div>
        <h3>Лечение кариеса и каналов</h3>
        <p>Лечение под микроскопом, эстетическая реставрация, лечение осложнённого кариеса.</p>
        <div class="service__price">
          <span class="service__price-label">от</span>
          <span class="service__price-value">4 950 ₽</span>
        </div>
        <a href="#booking" class="service__link">
          Записаться
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </a>
      </div>
      <div class="service" data-reveal style="--delay: 80ms">
        <div class="service__num">02 / Имплантология</div>
        <h3>Имплантация зубов</h3>
        <p>Установка имплантов, одномоментная имплантация, синус-лифтинг и костная пластика.</p>
        <div class="service__price">
          <span class="service__price-label">от</span>
          <span class="service__price-value">50 000 ₽</span>
        </div>
        <a href="#booking" class="service__link">
          Записаться
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </a>
      </div>
      <div class="service" data-reveal style="--delay: 160ms">
        <div class="service__num">03 / Ортодонтия</div>
        <h3>Исправление прикуса</h3>
        <p>Брекет-системы, элайнеры, исправление прикуса у взрослых и детей с любым уровнем сложности.</p>
        <div class="service__price">
          <span class="service__price-label">от</span>
          <span class="service__price-value">50 000 ₽</span>
        </div>
        <a href="#booking" class="service__link">
          Записаться
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </a>
      </div>
      <div class="service" data-reveal style="--delay: 240ms">
        <div class="service__num">04 / Ортопедия</div>
        <h3>Протезирование</h3>
        <p>Коронки из диоксида циркония, виниры, съёмные и несъёмные протезы, вкладки.</p>
        <div class="service__price">
          <span class="service__price-label">от</span>
          <span class="service__price-value">9 000 ₽</span>
        </div>
        <a href="#booking" class="service__link">
          Записаться
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </a>
      </div>
      <div class="service" data-reveal style="--delay: 320ms">
        <div class="service__num">05 / Хирургия</div>
        <h3>Хирургическая стоматология</h3>
        <p>Атравматичное удаление зубов, сложные случаи, подготовка к имплантации.</p>
        <div class="service__price">
          <span class="service__price-label">от</span>
          <span class="service__price-value">2 700 ₽</span>
        </div>
        <a href="#booking" class="service__link">
          Записаться
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </a>
      </div>
      <div class="service" data-reveal style="--delay: 400ms">
        <div class="service__num">06 / Гигиена</div>
        <h3>Профгигиена и эстетика</h3>
        <p>Профессиональная чистка, Air Flow, отбеливание и профилактические осмотры.</p>
        <div class="service__price">
          <span class="service__price-label">от</span>
          <span class="service__price-value">4 200 ₽</span>
        </div>
        <a href="#booking" class="service__link">
          Записаться
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- ========================================== -->
<!-- 8. ВРАЧИ (Заглушки для демо)               -->
<!-- ========================================== -->
<section class="section" id="doctors">
  <div class="container">
    <div class="section__head" data-reveal>
      <div class="eyebrow">Наши врачи</div>
      <h2 class="section-title">Врачи, которым доверяют улыбку</h2>
      <p class="section-sub">Специалисты с многолетним опытом и постоянным повышением квалификации.</p>
    </div>
    <div class="doctors">
      <?php for($i=1; $i<=7; $i++): ?>
      <div class="doctor" data-reveal style="--delay: <?php echo $i * 80; ?>ms">
        <div class="doctor__photo">
          <img src="image/placeholder.jpg" alt="Врач-стоматолог" loading="lazy" width="300" height="330"
               onerror="this.style.display='none';this.parentElement.classList.add('no-photo');">
        </div>
        <div class="doctor__body">
          <div class="doctor__name">Иванов Иван Иванович</div>
          <div class="doctor__role">Стоматолог-терапевт</div>
          <div class="doctor__meta">Стаж работы более 10 лет</div>
        </div>
      </div>
      <?php endfor; ?>
    </div>
  </div>
</section>

<!-- ========================================== -->
<!-- 9. ЦЕНЫ                                    -->
<!-- ========================================== -->
<section class="section section--white" id="prices">
  <div class="container">
    <div class="section__head" data-reveal>
      <div class="eyebrow">Стоимость</div>
      <h2 class="section-title">Прозрачные цены на основные услуги</h2>
      <p class="section-sub">Точную стоимость врач называет после осмотра и составления плана лечения.</p>
    </div>
    <div class="prices-wrap" data-reveal>
      <div class="price-row"><div class="price-row__name">Консультация стоматолога / ортопеда / имплантолога</div><div class="price-row__value">Бесплатно</div></div>
      <div class="price-row"><div class="price-row__name">Консультация ортодонта</div><div class="price-row__value">от 500 ₽</div></div>
      <div class="price-row"><div class="price-row__name">Лечение кариеса</div><div class="price-row__value">от 4 950 ₽</div></div>
      <div class="price-row"><div class="price-row__name">Комплексная гигиена полости рта</div><div class="price-row__value">от 4 200 ₽</div></div>
      <div class="price-row"><div class="price-row__name">Удаление зуба</div><div class="price-row__value">от 2 700 ₽</div></div>
      <div class="price-row"><div class="price-row__name">Удаление зуба мудрости</div><div class="price-row__value">от 4 000 ₽</div></div>
      <div class="price-row"><div class="price-row__name">Установка металлокерамической коронки</div><div class="price-row__value">от 9 000 ₽</div></div>
      <div class="price-row"><div class="price-row__name">Установка коронки из диоксида циркония</div><div class="price-row__value">от 16 000 ₽</div></div>
      <div class="price-row"><div class="price-row__name">Установка съемного протеза</div><div class="price-row__value">от 9 000 ₽</div></div>
      <div class="price-row"><div class="price-row__name">Установка брекетов</div><div class="price-row__value">от 50 000 ₽</div></div>
      <div class="price-row"><div class="price-row__name">Имплантация зубов под ключ</div><div class="price-row__value">от 50 000 ₽</div></div>
      <div class="price-row"><div class="price-row__name">Отбеливание зубов (Beyond)</div><div class="price-row__value">от 12 000 ₽</div></div>
    </div>
    <p class="price-note" data-reveal>* Цены указаны для ознакомления и не являются публичной офертой. Актуальный прайс уточняйте по телефону.</p>
  </div>
</section>

<!-- ========================================== -->
<!-- 10. ОТЗЫВЫ                                 -->
<!-- ========================================== -->
<section class="section" id="reviews">
  <div class="container">
    <div class="section__head" data-reveal>
      <div class="eyebrow">Отзывы</div>
      <h2 class="section-title">Что говорят наши пациенты</h2>
      <p class="section-sub">Средний рейтинг клиники на Яндекс.Картах — 4,4 из 5 на основе 17 отзывов.</p>
    </div>
    
    <div class="reviews" id="reviewsContainer">
      <?php
      // Выводим только одобренные отзывы (published)
      $rev_query = $conn->query("SELECT * FROM reviews WHERE status = 'published' ORDER BY id DESC LIMIT 9");
      if ($rev_query && $rev_query->num_rows > 0):
          while($rev = $rev_query->fetch_assoc()):
      ?>
      <div class="review" data-reveal>
        <div class="review__head">
          <div class="review__stars" aria-label="Оценка <?php echo $rev['rating']; ?> из 5">
              <?php echo str_repeat('★', $rev['rating']); ?>
          </div>
          <div class="review__source">Сайт</div>
        </div>
        <p class="review__text">«<?php echo htmlspecialchars($rev['text']); ?>»</p>
        <div class="review__author">
          <div class="review__avatar"><?php echo mb_substr(htmlspecialchars($rev['author']), 0, 1); ?></div>
          <div>
            <div class="review__name"><?php echo htmlspecialchars($rev['author']); ?></div>
            <div class="review__date"><?php echo date('d.m.Y', strtotime($rev['date'])); ?></div>
          </div>
        </div>
      </div>
      <?php 
          endwhile; 
      else:
          // Заглушка, если отзывов пока нет
          echo '<p style="text-align:center; width:100%; color:var(--muted);">Пока нет отзывов. Будьте первым!</p>';
      endif;
      ?>
    </div>

    <!-- Кнопка открытия формы -->
    <div style="text-align: center; margin-top: 40px;">
      <button class="btn btn--primary" onclick="document.getElementById('reviewFormWrap').style.display='block'; this.style.display='none';">
        ✍️ Оставить отзыв
      </button>
    </div>

    <!-- Скрытая форма -->
    <div id="reviewFormWrap" style="display: none; max-width: 600px; margin: 30px auto 0; background: var(--white); padding: 30px; border-radius: var(--radius-lg); box-shadow: var(--shadow-lg); border: 1px solid var(--border);">
      <h3 style="font-size: 22px; margin-bottom: 20px; text-align:center;">Оставить отзыв</h3>
      <form id="publicReviewForm">
        <div class="form-group">
          <label class="form-label">Ваше имя *</label>
          <input type="text" name="author" class="form-input" required placeholder="Иван И.">
        </div>
        <div class="form-group">
          <label class="form-label">Оценка *</label>
          <select name="rating" class="form-input" style="cursor:pointer;">
            <option value="5">★★★★★ (Отлично)</option>
            <option value="4">★★★★☆ (Хорошо)</option>
            <option value="3">★★★☆☆ (Нормально)</option>
            <option value="2">★★☆☆☆ (Плохо)</option>
            <option value="1">★☆☆☆☆ (Ужасно)</option>
          </select>
        </div>
        <div class="form-group">
          <label class="form-label">Текст отзыва *</label>
          <textarea name="text" class="form-input" rows="4" required placeholder="Расскажите о вашем опыте..."></textarea>
        </div>
        <button type="submit" class="btn btn--accent" style="width: 100%;">Отправить на проверку</button>
        <div class="form-success" id="revSuccess" style="display:none; margin-top:15px; background:#EBF9F1; color:#2E7D50; padding:15px; border-radius:8px; text-align:center;"></div>
        <div class="form-error-global" id="revError" style="display:none; margin-top:15px; background:#FDF0F0; color:#B33A3A; padding:15px; border-radius:8px; text-align:center;"></div>
      </form>
    </div>

  </div>
</section>
<!-- ========================================== -->
<!-- 10.5. НОВОСТИ                              -->
<!-- ========================================== -->
<section class="section section--white" id="news">
  <div class="container">
    <div class="section__head" data-reveal>
      <div class="eyebrow">Новости</div>
      <h2 class="section-title">Жизнь нашей клиники</h2>
      <p class="section-sub">Акции, важные события и полезные советы от наших врачей.</p>
    </div>

    <div class="reviews" style="grid-template-columns: repeat(3, 1fr);">
      <?php
      // Выводим 3 последние ОПУБЛИКОВАННЫЕ новости
      $news_query = $conn->query("SELECT * FROM news WHERE status = 'published' ORDER BY created_at DESC LIMIT 3");
      if ($news_query && $news_query->num_rows > 0):
          while($n = $news_query->fetch_assoc()):
      ?>
      <div class="review" data-reveal style="padding: 0; overflow: hidden; display: flex; flex-direction: column;">
        <!-- Картинка новости -->
        <?php if ($n['image']): ?>
            <div style="height: 200px; width: 100%; overflow: hidden; background: var(--accent-light);">
                <img src="<?= htmlspecialchars($n['image']) ?>" alt="" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s;">
            </div>
        <?php else: ?>
            <div style="height: 200px; width: 100%; display: flex; align-items: center; justify-content: center; background: var(--accent-light); color: var(--accent); font-size: 40px;">
                📰
            </div>
        <?php endif; ?>
        
        <!-- Текст новости -->
        <div style="padding: 24px; display: flex; flex-direction: column; flex: 1;">
            <div style="font-size: 12px; color: var(--muted); margin-bottom: 8px;">
                <?= date('d.m.Y', strtotime($n['created_at'])) ?>
            </div>
            <h3 style="font-family: var(--display); font-size: 18px; color: var(--navy); margin-bottom: 10px; line-height: 1.3;">
                <?= htmlspecialchars($n['title']) ?>
            </h3>
            <p style="font-size: 14px; color: var(--muted); margin-bottom: 20px; flex: 1; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                <?= htmlspecialchars($n['excerpt'] ?: strip_tags($n['content'])) ?>
            </p>
            <a href="news_view.php?id=<?= $n['id'] ?>" class="service__link" style="margin-top: auto;">
                Читать далее
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>
      </div>
      <?php 
          endwhile; 
      else:
          echo '<p style="text-align:center; width:100%; color:var(--muted); grid-column: 1 / -1;">Пока нет опубликованных новостей.</p>';
      endif;
      ?>
    </div>

    <?php if ($news_query && $news_query->num_rows > 0): ?>
    <div style="text-align: center; margin-top: 40px;" data-reveal>
      <a href="news_public.php" class="btn btn--ghost">Все новости →</a>
    </div>
    <?php endif; ?>
  </div>
</section>

<!-- Скрипт для отправки отзыва без перезагрузки -->
<script>
document.getElementById('publicReviewForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const btn = this.querySelector('button[type="submit"]');
    const originalText = btn.textContent;
    btn.textContent = 'Отправка...';
    btn.disabled = true;
    
    const successDiv = document.getElementById('revSuccess');
    const errorDiv = document.getElementById('revError');
    successDiv.style.display = 'none';
    errorDiv.style.display = 'none';

    try {
        const formData = new FormData(this);
        const res = await fetch('submit_review.php', { method: 'POST', body: formData });
        const data = await res.json();

        if (data.status === 'success') {
            successDiv.textContent = data.message;
            successDiv.style.display = 'block';
            this.reset();
            setTimeout(() => { 
                document.getElementById('reviewFormWrap').style.display = 'none';
                successDiv.style.display = 'none';
            }, 4000);
        } else {
            errorDiv.textContent = data.message;
            errorDiv.style.display = 'block';
        }
    } catch (err) {
        errorDiv.textContent = 'Ошибка сети. Попробуйте позже.';
        errorDiv.style.display = 'block';
    } finally {
        btn.textContent = originalText;
        btn.disabled = false;
    }
});
</script>

<!-- ========================================== -->
<!-- 11. CTA                                    -->
<!-- ========================================== -->
<section class="section" style="padding-top: 0;">
  <div class="container">
    <div class="cta" data-reveal>
      <div class="cta__content">
        <h2>Первый шаг к здоровой улыбке</h2>
        <p>Оставьте заявку — администратор перезвонит и подберёт удобное время для визита.</p>
      </div>
      <div class="cta__actions">
        <a href="tel:+79247600094" class="btn btn--white">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.13.96.36 1.9.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0122 16.92z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          Позвонить
        </a>
        <a href="#booking" class="btn btn--accent">Записаться</a>
      </div>
    </div>
  </div>
</section>

<!-- ========================================== -->
<!-- 12. КОНТАКТЫ И ФОРМА                       -->
<!-- ========================================== -->
<section class="section section--white" id="contacts">
  <div class="container">
    <div class="section__head" data-reveal>
      <div class="eyebrow">Контакты</div>
      <h2 class="section-title">Ждём вас в клинике</h2>
      <p class="section-sub">Запишитесь прямо на сайте или позвоните нам. Мы свяжемся с вами в ближайшее время.</p>
    </div>
    <div class="contacts">

      <div class="contacts__info" data-reveal id="booking">
        <!--
          ⚠️ ВАЖНО: чтобы форма реально отправляла заявки, зарегистрируйтесь на formspree.io
          (бесплатно до 50 заявок/мес.), создайте форму и замените YOUR_FORM_ID ниже на свой ID.
          Либо замените action на свой серверный скрипт (например, /send.php).
        -->
        <form class="booking-form" id="bookingForm" action="send.php" method="POST" novalidate>
          <h3>Записаться на приём</h3>
          <p>Оставьте ваши данные, и мы подберём удобное время.</p>

         <!-- Honeypot для защиты от спам-ботов -->
<input type="text" name="_gotcha" style="display:none" tabindex="-1" autocomplete="off">
          <!-- Honeypot для защиты от спам-ботов -->
          <input type="text" name="_gotcha" style="display:none" tabindex="-1" autocomplete="off">

          <div class="form-group">
            <label class="form-label" for="name">Ваше имя *</label>
            <input type="text" id="name" name="name" class="form-input" placeholder="Иван Иванов" required autocomplete="name">
            <div class="form-error" id="nameError">Пожалуйста, введите ваше имя (минимум 2 символа).</div>
          </div>

          <div class="form-group">
            <label class="form-label" for="phone">Телефон *</label>
            <input type="tel" id="phone" name="phone" class="form-input" placeholder="+7 (___) ___-__-__" required autocomplete="tel" inputmode="tel">
            <div class="form-error" id="phoneError">Пожалуйста, введите корректный номер телефона.</div>
          </div>

          <div class="form-group">
            <label class="form-label" for="service">Услуга</label>
            <select id="service" name="service" class="form-input">
              <option value="">Выберите услугу (необязательно)</option>
              <option value="consult">Консультация</option>
              <option value="therapy">Лечение кариеса</option>
              <option value="implant">Имплантация</option>
              <option value="ortho">Исправление прикуса</option>
              <option value="prosthetics">Протезирование</option>
              <option value="hygiene">Профессиональная гигиена</option>
            </select>
          </div>

          <label class="form-checkbox" id="checkboxGroup">
  <input type="checkbox" id="agreement" name="agreement" required>
  <span>
    Я даю согласие на обработку персональных данных в соответствии с
    <a href="consent.php" target="_blank" rel="noopener">текстом согласия</a>
    и
    <a href="privacy.php
    " target="_blank" rel="noopener">политикой конфиденциальности</a>
  </span>
</label>
<div class="form-error" id="agreementError" style="margin-top: -16px; margin-bottom: 16px;">Необходимо согласие на обработку данных.</div>
<input type="hidden" name="consent_version" value="consent-2026-01-01">

          <button type="submit" class="btn btn--primary" id="submitBtn">
            <span id="submitBtnText">Отправить заявку</span>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
              <path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </button>

          <div class="form-success" id="formSuccess" role="status" aria-live="polite">
            ✅ Спасибо! Ваша заявка отправлена. Мы свяжемся с вами в ближайшее время.
          </div>
          <div class="form-error-global" id="formError" role="alert">
            ⚠️ Не удалось отправить заявку. Пожалуйста, позвоните нам по телефону +7 (924) 760-00-94.
          </div>
        </form>
      </div>

      <div style="display: flex; flex-direction: column;">
        <div class="contact-card" data-reveal style="--delay: 100ms">
          <div class="contact-card__icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/>
              <circle cx="12" cy="10" r="3"/>
            </svg>
          </div>
          <div>
            <div class="contact-card__label">Основной филиал</div>
            <div class="contact-card__value">ул. Примерная, 1, Ваш город</div>          </div>
        </div>

        <div class="contact-card" data-reveal style="--delay: 150ms">
          <div class="contact-card__icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.13.96.36 1.9.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0122 16.92z"/>
            </svg>
          </div>
          <div>
            <div class="contact-card__label">Телефон</div>
            <div class="contact-card__value"><a href="tel:+79991234567">+7 (999) 123-45-67</a></div>          </div>
        </div>

        <div class="contact-card" data-reveal style="--delay: 200ms">
          <div class="contact-card__icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <circle cx="12" cy="12" r="10"/>
              <polyline points="12 6 12 12 16 14"/>
            </svg>
          </div>
          <div>
            <div class="contact-card__label">Режим работы</div>
            <div class="contact-card__value">Пн–Сб: 09:00–19:00<br>Вс: выходной</div>
          </div>
        </div>

        <div class="contacts__map" data-reveal style="--delay: 250ms">
                    <iframe
            src="https://yandex.ru/map-widget/v1/?ll=129.719925%2C62.022709&z=16&pt=129.719925,62.022709,pm2rdm"
            allowfullscreen
            loading="lazy"
            title="Карта клиники">
          </iframe>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ========================================== -->
<!-- 13. ФУТЕР                                  -->
<!-- ========================================== -->
<footer class="footer">
  <div class="container">
    <div class="footer__grid">
      <div>
        <a href="#" class="logo">
          <span class="logo__mark">
            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
              <path d="M12 3C8 3 5 5.5 5 9c0 2.5 1 4 1 6 0 3 1 6 2.5 6 1.5 0 1.2-3 3.5-3s2 3 3.5 3c1.5 0 2.5-3 2.5-6 0-2 1-3.5 1-6 0-3.5-3-6-7-6z" fill="#fff"/>
            </svg>
          </span>
          <span>ВашаСтоматология<em>+</em></span>
        </a>
                <p class="footer__about">
          Стоматологическая клиника. Лечение, имплантация, ортодонтия и протезирование — с заботой о каждом пациенте.
        </p>
        <!-- Соцсети: замените ссылки на свои -->
        <div class="footer__socials">
          <a href="https://vk.ru/id1132055080" target="_blank" rel="noopener" aria-label="ВКонтакте">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
              <path d="M13.162 18.994c.609 0 .858-.406.851-.915-.031-1.917.714-2.949 2.059-1.604 1.488 1.488 1.796 2.519 3.603 2.519h3.2c.808 0 1.126-.26 1.126-.668 0-.863-1.421-2.386-2.625-3.504-1.686-1.565-1.765-1.602-.313-3.486 1.801-2.339 4.157-5.336 2.073-5.336h-3.981c-.772 0-.828.435-1.103 1.083-.995 2.347-2.886 5.387-3.604 4.922-.751-.485-.407-2.406-.35-5.261.015-.754.011-1.271-1.141-1.539-.629-.145-1.241-.205-1.809-.205-2.273 0-3.841.953-2.95 1.119 1.571.293 1.42 3.692 1.054 5.16-.638 2.556-3.036-2.024-4.035-4.305-.241-.548-.315-.974-1.175-.974H.551c-.492 0-.787.16-.787.516 0 .602 2.96 6.72 5.786 9.77 2.756 2.975 5.575 2.389 7.612 2.389z"/>
            </svg>
          </a>
          <a href="https://t.me/meelwaay" target="_blank" rel="noopener" aria-label="Telegram">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
              <path d="M11.944 0A12 12 0 000 12a12 12 0 0012 12 12 12 0 0012-12A12 12 0 0012 0a12 12 0 00-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 01.171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/>
            </svg>
          </a>
          <a href="https://wa.me/79247600094" target="_blank" rel="noopener" aria-label="WhatsApp">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
              <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
            </svg>
          </a>
        </div>
      </div>
      <div>
        <h4>Клиника</h4>
        <ul>
          <li><a href="#services">Услуги</a></li>
          <li><a href="#doctors">Врачи</a></li>
          <li><a href="#prices">Цены</a></li>
          <li><a href="#reviews">Отзывы</a></li>
        </ul>
      </div>
      <div>
        <h4>Пациентам</h4>
        <ul>
          <li><a href="#booking">Записаться на приём</a></li>
          <li><a href="#contacts">Адрес и карта</a></li>
          <li><a href="privacy.php">Политика конфиденциальности</a></li>
          <li><a href="tel:+79247600094">Позвонить</a></li>
        </ul>
      </div>
      <div>
        <h4>Контакты</h4>
        <ul>
          <li><a href="tel:+79247600094">+7 (999) 123-45-67</a></li>
          <li><a href="mailto:eurostom66@mail.ru">eurostom66@mail.ru</a></li>
          <li>ул. Ойунского, 24/2</li>
          <li>Пн–Сб: 09:00–19:00</li>
        </ul>
      </div>
    </div>
           <div class="footer__bottom">
      <span>© 2026 Стоматология «Ваша стоматология». Все права защищены.</span>
      <span>Лицензия на медицинскую деятельность · ИНН 0000000000</span>
    </div>
        Лицензия на медицинскую деятельность · ИНН 0000000000 ·
        <a href="login.php" style="color: inherit; opacity: .6;">⚙️ Админка</a>
      </span>
    </div>
</footer>

<!-- ========================================== -->
<!-- 14. МОБИЛЬНАЯ ПАНЕЛЬ СНИЗУ                 -->
<!-- ========================================== -->
<div class="mobile-bar">
  <a href="tel:+79991234567" class="btn btn--ghost">
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
      <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.13.96.36 1.9.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0122 16.92z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    Позвонить
  </a>
  <a href="#booking" class="btn btn--primary">Записаться</a>
</div>
<!-- ПЛАШКА COOKIE -->
<div class="cookie-banner" id="cookieBanner">
  <div class="cookie-banner__text">
    Мы используем файлы cookie для улучшения работы сайта. Продолжая пользоваться сайтом, вы соглашаетесь с нашей <a href="privacy.php" target="_blank">политикой конфиденциальности</a>.
  </div>
  <button class="cookie-banner__btn" id="cookieAccept">Принять</button>
</div>
<!-- ========================================== -->
<!-- 15. ПЛАВАЮЩАЯ КНОПКА WHATSAPP              -->
<!-- ========================================== -->
<a href="https://wa.me/79991234567?text=Здравствуйте!%20Хочу%20записаться%20на%20приём%20в%20ВашаСтоматология%2B"
   class="fab-wa" target="_blank" rel="noopener" aria-label="Написать в WhatsApp">
  <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
  </svg>
</a>

<!-- ========================================== -->
<!-- 16. СКРИПТЫ                                -->
<!-- ========================================== -->
<script>
  // Прогресс-бар + фикс шапки
  const progress = document.getElementById('progress');
  const header = document.getElementById('header');

  window.addEventListener('scroll', () => {
    const h = document.documentElement;
    const p = h.scrollTop / (h.scrollHeight - h.clientHeight) * 100;
    progress.style.width = p + '%';
    header.classList.toggle('is-scrolled', window.scrollY > 20);
  }, { passive: true });

  // Бургер-меню
  const burger = document.getElementById('burger');
  const menu = document.getElementById('menu');

  burger.addEventListener('click', () => {
    const open = burger.classList.toggle('is-open');
    burger.setAttribute('aria-expanded', open ? 'true' : 'false');
    menu.classList.toggle('is-open', open);
    document.body.style.overflow = open ? 'hidden' : '';
  });

  menu.querySelectorAll('a').forEach(a => {
    a.addEventListener('click', () => {
      burger.classList.remove('is-open');
      burger.setAttribute('aria-expanded', 'false');
      menu.classList.remove('is-open');
      document.body.style.overflow = '';
    });
  });

  // Анимация появления
  const revealObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('in');
        revealObserver.unobserve(entry.target);
      }
    });
  }, { threshold: 0.08, rootMargin: '0px 0px -40px 0px' });

  document.querySelectorAll('[data-reveal]').forEach(el => revealObserver.observe(el));

  // Параллакс hero
  const heroImg = document.querySelector('.hero__image img');
  if (heroImg && window.matchMedia('(min-width: 861px)').matches) {
    window.addEventListener('scroll', () => {
      if (window.scrollY < window.innerHeight) {
        heroImg.style.transform = `translateY(${window.scrollY * 0.06}px) scale(1.03)`;
      }
    }, { passive: true });
  }

  // === ВАЛИДАЦИЯ И ОТПРАВКА ФОРМЫ ===
  const form = document.getElementById('bookingForm');
  const nameInput = document.getElementById('name');
  const phoneInput = document.getElementById('phone');
  const agreementCheckbox = document.getElementById('agreement');
  const submitBtn = document.getElementById('submitBtn');
  const submitBtnText = document.getElementById('submitBtnText');

  const nameError = document.getElementById('nameError');
  const phoneError = document.getElementById('phoneError');
  const agreementError = document.getElementById('agreementError');
  const formSuccess = document.getElementById('formSuccess');
  const formError = document.getElementById('formError');
  const checkboxGroup = document.getElementById('checkboxGroup');

  // Маска телефона
  phoneInput.addEventListener('input', function () {
    let value = this.value.replace(/\D/g, '');
    if (value.length === 0) { this.value = ''; return; }
    if (value[0] === '8') value = '7' + value.substring(1);
    if (value[0] !== '7') value = '7' + value;

    let formatted = '+7 ';
    if (value.length > 1) formatted += '(' + value.substring(1, 4);
    if (value.length > 4) formatted += ') ' + value.substring(4, 7);
    if (value.length > 7) formatted += '-' + value.substring(7, 9);
    if (value.length > 9) formatted += '-' + value.substring(9, 11);

    this.value = formatted;

    if (this.classList.contains('is-invalid')) {
      this.classList.remove('is-invalid');
      phoneError.classList.remove('is-visible');
    }
  });

  nameInput.addEventListener('input', function () {
    if (this.classList.contains('is-invalid')) {
      this.classList.remove('is-invalid');
      nameError.classList.remove('is-visible');
    }
  });

  agreementCheckbox.addEventListener('change', function () {
    if (this.checked) {
      checkboxGroup.classList.remove('is-invalid');
      agreementError.classList.remove('is-visible');
    }
  });

  // Отправка
  form.addEventListener('submit', async function (e) {
    e.preventDefault();

    let isValid = true;
    formSuccess.classList.remove('is-visible');
    formError.classList.remove('is-visible');

    // Имя
    const nameValue = nameInput.value.trim();
    if (nameValue.length < 2) {
      nameInput.classList.add('is-invalid');
      nameError.classList.add('is-visible');
      isValid = false;
    } else {
      nameInput.classList.remove('is-invalid');
      nameError.classList.remove('is-visible');
    }

    // Телефон
    const phoneDigits = phoneInput.value.replace(/\D/g, '');
    if (phoneDigits.length !== 11) {
      phoneInput.classList.add('is-invalid');
      phoneError.classList.add('is-visible');
      isValid = false;
    } else {
      phoneInput.classList.remove('is-invalid');
      phoneError.classList.remove('is-visible');
    }

    // Согласие
    if (!agreementCheckbox.checked) {
      checkboxGroup.classList.add('is-invalid');
      agreementError.classList.add('is-visible');
      isValid = false;
    } else {
      checkboxGroup.classList.remove('is-invalid');
      agreementError.classList.remove('is-visible');
    }

    if (!isValid) return;

    // Отправка на сервер (Formspree / ваш бэкенд)
    submitBtn.disabled = true;
    submitBtnText.textContent = 'Отправляем...';

        try {
      const formData = new FormData(form);
      const response = await fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: { 'Accept': 'application/json' }
      });

      let data = null;
      try { data = await response.json(); } catch (_) {}

      if (response.ok && data && data.status === 'success') {
        formSuccess.classList.add('is-visible');
        form.reset();
        phoneInput.value = '';
        formSuccess.scrollIntoView({ behavior: 'smooth', block: 'center' });

        if (typeof ym === 'function' && window.YM_COUNTER_ID) {
          ym(window.YM_COUNTER_ID, 'reachGoal', 'FORM_SUBMIT');
        }

        setTimeout(() => formSuccess.classList.remove('is-visible'), 8000);
      } else {
        throw new Error((data && data.message) || 'Server error');
      }
    } catch (err) {
      console.error(err);
      formError.classList.add('is-visible');
      formError.scrollIntoView({ behavior: 'smooth', block: 'center' });
    } finally {
      submitBtn.disabled = false;
      submitBtnText.textContent = 'Отправить заявку';
    }
  });
</script>

<!-- ========================================== -->
<!-- 17. ЯНДЕКС.МЕТРИКА                         -->
<!-- ========================================== -->
<!--
  ⚠️ Замените YOUR_METRIKA_ID на номер вашего счётчика.
  Получить его можно на metrika.yandex.ru (бесплатно).
-->
<script>
  window.YM_COUNTER_ID = 113738964; // <-- замените на ваш ID
</script>
<script type="text/javascript">
  (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
  m[i].l=1*new Date();
  for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
  k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
  (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

  if (window.YM_COUNTER_ID) {
    ym(window.YM_COUNTER_ID, "init", {
      clickmap: true,
      trackLinks: true,
      accurateTrackBounce: true,
      webvisor: true
    });
  }
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/113738964" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<script>
  // Логика работы плашки Cookie
  document.addEventListener("DOMContentLoaded", function() {
    const cookieBanner = document.getElementById('cookieBanner');
    const cookieAccept = document.getElementById('cookieAccept');
    
    // Проверяем, принял ли пользователь cookie ранее
    if (!localStorage.getItem('cookieAccepted')) {
      // Если нет, показываем плашку с задержкой в 1.5 секунды
      setTimeout(() => {
        cookieBanner.classList.add('is-visible');
      }, 1500);
    }

    // По клику на кнопку "Принять"
    cookieAccept.addEventListener('click', () => {
      localStorage.setItem('cookieAccepted', 'true');
      cookieBanner.classList.remove('is-visible');
    });
  });
</script>
</body>
</html>