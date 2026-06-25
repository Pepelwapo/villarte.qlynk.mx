<?php
// ─────────────────────────────────────────────
// VillArte | Procesamiento del formulario
// Envío desde: info@villarte.qlynk.mx
// ─────────────────────────────────────────────
$form_success = false;
$form_error   = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['form_contact'])) {

    $name    = htmlspecialchars(trim($_POST['name']    ?? ''));
    $email   = htmlspecialchars(trim($_POST['email']   ?? ''));
    $phone   = htmlspecialchars(trim($_POST['phone']   ?? ''));
    $service = htmlspecialchars(trim($_POST['service'] ?? ''));
    $message = htmlspecialchars(trim($_POST['message'] ?? ''));

    if (!$name || !$email || !$message) {
        $form_error = 'Por favor completa los campos obligatorios: nombre, correo y mensaje.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $form_error = 'El correo electrónico ingresado no es válido.';
    } else {
        $to      = 'info@villarte.qlynk.mx';
        $subject = '=?UTF-8?B?' . base64_encode("Nueva cotización VillArte – $service") . '?=';
        $body    = "Nueva solicitud de información\n"
                 . "================================\n"
                 . "Nombre:   $name\n"
                 . "Correo:   $email\n"
                 . "Teléfono: $phone\n"
                 . "Servicio: $service\n\n"
                 . "Mensaje:\n$message\n";

        $headers  = "From: VillArte Web <info@villarte.qlynk.mx>\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();

        if (mail($to, $subject, $body, $headers)) {
            $form_success = true;
        } else {
            $form_error = 'Hubo un problema al enviar el mensaje. Por favor intenta de nuevo o llámanos al 81 2619 4101.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es-MX">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>VillArte | Vinil Impreso, Etiquetas, Lonas y Soluciones Visuales en Monterrey</title>

<meta name="description"
      content="Especialistas en vinil impreso, etiquetas personalizadas, lonas, banners, microperforado, rotulación y soluciones visuales para empresas, negocios, restaurantes, profesionales y hogar en Monterrey y área metropolitana. Tel: 8126194101.">

<meta name="keywords"
      content="vinil impreso monterrey, etiquetas personalizadas monterrey, stickers personalizados monterrey, impresión de lonas monterrey, banners monterrey, microperforado ventanas, rotulación vehicular monterrey, publicidad negocios monterrey, impresión gran formato monterrey, señalización empresas monterrey, material corporativo monterrey, imprenta monterrey, imprenta san pedro garza garcia, impresión apodaca nuevo leon, impresión guadalupe nuevo leon, impresión san nicolas nuevo leon, soluciones visuales monterrey, murales decorativos monterrey">

<meta name="author"  content="VillArte Impresión y Soluciones Visuales">
<meta name="robots"  content="index, follow">
<link rel="canonical" href="https://www.villartemty.com/">

<!-- Open Graph -->
<meta property="og:title"       content="VillArte | Impresión y Soluciones Visuales en Monterrey">
<meta property="og:description" content="Vinil impreso, etiquetas, lonas, banners y rotulación para tu empresa en Monterrey. Cotiza: 8126194101.">
<meta property="og:type"        content="website">
<meta property="og:url"         content="https://www.villartemty.com/">
<meta property="og:image"       content="https://www.villartemty.com/img/LogoVillArte1.png">
<meta property="og:locale"      content="es_MX">

<!-- Schema LocalBusiness -->
<script type="application/ld+json">
{
  "@context":"https://schema.org",
  "@type":"LocalBusiness",
  "name":"VillArte Impresión y Soluciones Visuales",
  "image":"https://www.villartemty.com/img/LogoVillArte1.png",
  "url":"https://www.villartemty.com",
  "telephone":"+528126194101",
  "address":{
    "@type":"PostalAddress",
    "addressLocality":"Monterrey",
    "addressRegion":"Nuevo León",
    "addressCountry":"MX"
  },
  "description":"Especialistas en vinil impreso, etiquetas, lonas, banners y rotulación en Monterrey y área metropolitana."
}
</script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<link rel="stylesheet" href="css/style.css">

<style>
/* ── Sección de segmentos: 5 cards horizontales ──────────────── */
/* Reutiliza .service-card del CSS original; solo ajusta el grid */
.segments-section {
  padding: 100px 0;
}
.segments-section .container {
  display: grid;
  grid-template-columns: repeat(5, 1fr);
  gap: 25px;
}
@media(max-width:1100px){
  .segments-section .container { grid-template-columns: repeat(3,1fr); }
}
@media(max-width:700px){
  .segments-section .container { grid-template-columns: repeat(2,1fr); }
}

/* ── Formulario de contacto ───────────────────────────────────── */
.contact-section {
  padding: 120px 0;
  background: var(--bg);
}

.contact-grid {
  display: grid;
  grid-template-columns: 1fr 1.5fr;
  gap: 60px;
  align-items: start;
}

.contact-info h3 {
  font-size: 1.6rem;
  font-weight: 700;
  margin-bottom: 14px;
}

.contact-info p {
  color: #bdbdbd;
  margin-bottom: 32px;
  line-height: 1.7;
}

.contact-item {
  display: flex;
  align-items: center;
  gap: 14px;
  margin-bottom: 18px;
}

.ci-icon {
  width: 44px; height: 44px;
  border-radius: 50%;
  background: #101010;
  border: 1px solid #222;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1rem;
  flex-shrink: 0;
  background-image: var(--gradient);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

/* fix: icon background sin clip */
.ci-icon-wrap {
  width: 44px; height: 44px;
  border-radius: 50%;
  background: #101010;
  border: 1px solid #222;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}
.ci-icon-wrap svg { width: 20px; height: 20px; }

.ci-text strong {
  display: block;
  font-size: .72rem;
  color: #666;
  margin-bottom: 2px;
  letter-spacing: .5px;
  text-transform: uppercase;
}
.ci-text a, .ci-text span {
  font-size: .9rem;
  color: #fff;
  text-decoration: none;
}
.ci-text a:hover { color: var(--pink); }

/* Form box – mismo look que .benefit-card */
.form-box {
  background: #101010;
  border: 1px solid #1f1f1f;
  border-radius: 20px;
  padding: 40px 36px;
}

.form-box h3 {
  font-size: 1.2rem;
  font-weight: 700;
  margin-bottom: 26px;
}

.fg { margin-bottom: 16px; }

.fg label {
  display: block;
  font-size: .76rem;
  font-weight: 600;
  color: #666;
  margin-bottom: 6px;
  letter-spacing: .4px;
  text-transform: uppercase;
}

.fg input,
.fg select,
.fg textarea {
  width: 100%;
  background: #050505;
  border: 1px solid #222;
  color: #fff;
  padding: 12px 16px;
  border-radius: 12px;
  font-family: 'Poppins', sans-serif;
  font-size: .88rem;
  outline: none;
  transition: border-color .3s;
  appearance: none;
  -webkit-appearance: none;
}
.fg input:focus,
.fg select:focus,
.fg textarea:focus {
  border-color: var(--pink);
}
.fg select option  { background: #101010; }
.fg textarea       { resize: vertical; min-height: 108px; }

.fg-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 14px;
}
@media(max-width:700px){ .fg-row { grid-template-columns:1fr; } }

/* Botón de envío – misma clase .btn-primary del CSS original */
.btn-submit {
  width: 100%;
  padding: 16px 32px;
  border-radius: 50px;
  background: var(--gradient);
  color: white;
  font-family: 'Poppins', sans-serif;
  font-size: 1rem;
  font-weight: 600;
  border: none;
  cursor: pointer;
  margin-top: 8px;
  transition: opacity .3s, transform .3s;
}
.btn-submit:hover { opacity: .88; transform: translateY(-1px); }

/* Mensajes de feedback */
.form-msg {
  padding: 14px 18px;
  border-radius: 12px;
  font-size: .88rem;
  font-weight: 500;
  margin-bottom: 20px;
  display: flex;
  align-items: center;
  gap: 10px;
}
.form-msg.ok  {
  background: rgba(0,182,100,.1);
  border: 1px solid rgba(0,182,100,.3);
  color: #00c864;
}
.form-msg.err {
  background: rgba(255,45,141,.1);
  border: 1px solid rgba(255,45,141,.3);
  color: var(--pink);
}

@media(max-width:900px){
  .contact-grid { grid-template-columns: 1fr; gap: 40px; }
}
</style>

</head>

<body>

<!-- ════════════════════════════════
     HEADER
════════════════════════════════ -->
<header class="header">
  <div class="container">

    <a href="#inicio" class="logo">
      <img src="img/LogoVillArte1.png" alt="VillArte – Impresión y Soluciones Visuales Monterrey">
    </a>

    <nav class="nav">
      <a href="#inicio">Inicio</a>
      <a href="#segmentos">Servicios</a>
      <a href="#metodologia">Metodología</a>
      <a href="#galeria">Galería</a>
      <a href="#contacto">Contacto</a>
    </nav>

    <a href="#contacto" class="btn-header">Cotizar</a>

  </div>
</header>

<!-- ════════════════════════════════
     HERO
════════════════════════════════ -->
<section class="hero" id="inicio">
  <div class="container">
    <div class="hero-content">

      <span class="hero-badge">SOLUCIONES VISUALES</span>

      <h1>IMPRESIÓN Y<br>SOLUCIONES VISUALES</h1>

      <h2>Impulsamos la imagen<br>de tu negocio con impresión profesional</h2>

      <div class="hero-services">
        <span>Vinil Impreso</span>
        <span>Etiquetas</span>
        <span>Lonas</span>
        <span>Banners</span>
        <span>Señalización</span>
        <span>Rotulación</span>
        <span>Material Corporativo</span>
      </div>

      <div class="hero-buttons">
        <a href="#contacto" class="btn-primary">Solicitar Cotización</a>
        <a href="#galeria"  class="btn-secondary">Ver Trabajos</a>
      </div>

    </div>
  </div>
</section>

<!-- ════════════════════════════════
     SEGMENTOS — 5 cards horizontales
     (justo debajo del hero)
════════════════════════════════ -->
<section class="segments-section" id="segmentos">
  <div class="container">

    <div class="service-card" id="empresas">
      <h3>Empresas</h3>
      <p>Kits corporativos, gafetes, reconocimientos, señalización interna, banners y material de RRHH.</p>
    </div>

    <div class="service-card" id="negocios">
      <h3>Negocios</h3>
      <p>Etiquetas, stickers, vinil para escaparates, microperforado, lonas y publicidad exterior.</p>
    </div>

    <div class="service-card" id="restaurantes">
      <h3>Restaurantes</h3>
      <p>Menús, murales decorativos, promociones, displays de mostrador y rotulación de local.</p>
    </div>

    <div class="service-card" id="profesionales">
      <h3>Profesionales</h3>
      <p>Odontólogos, médicos, abogados, arquitectos y consultorios con imagen impecable.</p>
    </div>

    <div class="service-card" id="hogar">
      <h3>Hogar</h3>
      <p>Vinilos decorativos, cuadros impresos, murales personalizados y señalización para tu espacio.</p>
    </div>

  </div>
</section>

<!-- ════════════════════════════════
     NUESTRA FORMA DE TRABAJO
     (usa las clases del CSS original)
════════════════════════════════ -->
<section class="workflow" id="metodologia">
  <div class="container">

    <div class="section-title">
      <span>METODOLOGÍA EFECTIVA</span>
      <h2>Nuestra Forma de Trabajo</h2>
    </div>

    <div class="workflow-steps">

      <div class="step">
        <div class="step-number">1</div>
        <h3>Entendemos</h3>
        <p>Analizamos tu proyecto, marca y objetivos para ofrecer la mejor solución visual.</p>
      </div>

      <div class="step">
        <div class="step-number">2</div>
        <h3>Diseñamos</h3>
        <p>Creamos o adaptamos diseños enfocados en generar impacto visual.</p>
      </div>

      <div class="step">
        <div class="step-number">3</div>
        <h3>Producimos</h3>
        <p>Imprimimos utilizando materiales de calidad y equipos profesionales.</p>
      </div>

      <div class="step">
        <div class="step-number">4</div>
        <h3>Enviamos</h3>
        <p>Empacamos cuidadosamente y enviamos tu pedido listo para usar.</p>
      </div>

      <div class="step step-highlight">
        <div class="step-number success">✓</div>
        <h3>Tu Marca Destaca</h3>
        <p>Una imagen profesional genera confianza y atrae más clientes.</p>
      </div>

    </div>

    <div class="workflow-benefits">

      <div class="benefit-card">
        <h4>Diseño Profesional</h4>
        <p>Soluciones visuales creadas para fortalecer tu marca y diferenciarte de la competencia.</p>
      </div>

      <div class="benefit-card">
        <h4>Materiales de Calidad</h4>
        <p>Acabados profesionales y materiales seleccionados para larga durabilidad y mejor presentación.</p>
      </div>

      <div class="benefit-card">
        <h4>Entrega Puntual</h4>
        <p>Procesos optimizados para cumplir tiempos de producción y entrega en toda el área metropolitana.</p>
      </div>

    </div>

  </div>
</section>

<!-- ════════════════════════════════
     SOLICITAR INFORMACIÓN
════════════════════════════════ -->
<section class="contact-section" id="contacto">
  <div class="container">

    <div class="section-title">
      <span>COTIZA SIN COSTO</span>
      <h2>Solicitar Información</h2>
    </div>

    <div class="contact-grid">

      <!-- Datos de contacto -->
      <div class="contact-info">
        <h3>Hablemos de tu proyecto</h3>
        <p>Somos especialistas en impresión y soluciones visuales en Monterrey y toda el área metropolitana. Contáctanos y recibe una cotización personalizada sin costo.</p>

        <div class="contact-item">
          <div class="ci-icon-wrap">
            <svg viewBox="0 0 24 24" fill="none" stroke="url(#grad1)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <defs><linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" stop-color="#00B6FF"/><stop offset="100%" stop-color="#FF2D8D"/></linearGradient></defs>
              <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81a19.79 19.79 0 01-3.07-8.68A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92v2z"/>
            </svg>
          </div>
          <div class="ci-text">
            <strong>Teléfono</strong>
            <a href="tel:+528126194101">81 2619 4101</a>
          </div>
        </div>

        <div class="contact-item">
          <div class="ci-icon-wrap">
            <svg viewBox="0 0 24 24" fill="none" stroke="url(#grad2)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <defs><linearGradient id="grad2" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" stop-color="#8E4BFF"/><stop offset="100%" stop-color="#FF8A00"/></linearGradient></defs>
              <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/>
            </svg>
          </div>
          <div class="ci-text">
            <strong>Ubicación</strong>
            <a href="https://maps.google.com/?q=Monterrey,+Nuevo+León" target="_blank" rel="noopener">Monterrey, Nuevo León</a>
          </div>
        </div>

        <div class="contact-item">
          <div class="ci-icon-wrap">
            <svg viewBox="0 0 24 24" fill="none" stroke="url(#grad3)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <defs><linearGradient id="grad3" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" stop-color="#FF2D8D"/><stop offset="100%" stop-color="#FF8A00"/></linearGradient></defs>
              <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/>
            </svg>
          </div>
          <div class="ci-text">
            <strong>Correo</strong>
            <a href="mailto:info@villarte.qlynk.mx">info@villarte.qlynk.mx</a>
          </div>
        </div>

      </div>

      <!-- Formulario -->
      <div class="form-box">
        <h3>Envíanos un mensaje</h3>

        <?php if ($form_success): ?>
          <div class="form-msg ok">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
            Mensaje enviado exitosamente. Pronto nos pondremos en contacto contigo.
          </div>
        <?php elseif ($form_error): ?>
          <div class="form-msg err">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            <?= $form_error ?>
          </div>
        <?php endif; ?>

        <?php if (!$form_success): ?>
        <form method="POST" action="#contacto">
          <input type="hidden" name="form_contact" value="1">

          <div class="fg-row">
            <div class="fg">
              <label for="f-name">Nombre *</label>
              <input type="text" id="f-name" name="name" placeholder="Tu nombre completo" required
                     value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
            </div>
            <div class="fg">
              <label for="f-email">Correo electrónico *</label>
              <input type="email" id="f-email" name="email" placeholder="correo@ejemplo.com" required
                     value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
            </div>
          </div>

          <div class="fg-row">
            <div class="fg">
              <label for="f-phone">Teléfono</label>
              <input type="tel" id="f-phone" name="phone" placeholder="81 0000 0000"
                     value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
            </div>
            <div class="fg">
              <label for="f-service">Servicio de interés</label>
              <select id="f-service" name="service">
                <option value="">— Selecciona —</option>
                <?php
                $services = [
                  'Vinil Impreso','Etiquetas / Stickers','Lonas y Banners',
                  'Rotulación Vehicular','Señalización','Material Corporativo',
                  'Mural / Decorativo','Microperforado','Hogar / Decoración','Otro'
                ];
                foreach ($services as $s):
                  $sel = (($_POST['service'] ?? '') === $s) ? 'selected' : '';
                ?>
                <option value="<?= $s ?>" <?= $sel ?>><?= $s ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="fg">
            <label for="f-message">Descripción del proyecto *</label>
            <textarea id="f-message" name="message"
              placeholder="Cuéntanos: tipo de material, medidas aproximadas, cantidad, uso final..."
              required><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
          </div>

          <button type="submit" class="btn-submit">Enviar Mensaje</button>

        </form>
        <?php endif; ?>

      </div><!-- /form-box -->

    </div><!-- /contact-grid -->
  </div>
</section>

<!-- Sección galería (placeholder para contenido futuro) -->
<section id="galeria"></section>

<script src="js/app.js"></script>

</body>
</html>
