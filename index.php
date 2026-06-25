<?php
/* ─────────────────────────────────────────────────────────
   VillArte | Formulario de contacto
   Envío: info@villarte.qlynk.mx
───────────────────────────────────────────────────────── */
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
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;

        require __DIR__ . '/PHPMailer/src/Exception.php';
        require __DIR__ . '/PHPMailer/src/PHPMailer.php';
        require __DIR__ . '/PHPMailer/src/SMTP.php';

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'mail.villarte.qlynk.mx'; // servidor SMTP de HostGator
            $mail->SMTPAuth   = true;
            $mail->Username   = 'info@villarte.qlynk.mx'; // tu correo
            $mail->Password   = '.V1ll4rt3.';     // 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SSL;
            $mail->Port       = 465;
            $mail->CharSet    = 'UTF-8';

            $mail->setFrom('info@villarte.qlynk.mx', 'VillArte Web');
            $mail->addAddress('info@villarte.qlynk.mx');
            $mail->addReplyTo($email, $name);

            $mail->Subject = "Nueva cotización VillArte – $service";
            $mail->Body    = "Nueva solicitud de información\n"
                           . "================================\n"
                           . "Nombre:   $name\n"
                           . "Correo:   $email\n"
                           . "Teléfono: $phone\n"
                           . "Servicio: $service\n\n"
                           . "Mensaje:\n$message";

            $mail->send();
            $form_success = true;

        } catch (Exception $e) {
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

<meta name="description" content="Especialistas en vinil impreso, etiquetas personalizadas, lonas, banners, microperforado, rotulación y soluciones visuales para empresas, negocios, restaurantes, profesionales y hogar en Monterrey y área metropolitana. Tel: 8126194101.">

<meta name="keywords" content="vinil impreso monterrey, etiquetas personalizadas monterrey, stickers personalizados monterrey, impresión de lonas monterrey, banners monterrey, microperforado ventanas, rotulación vehicular monterrey, publicidad negocios monterrey, impresión gran formato monterrey, señalización empresas monterrey, material corporativo monterrey, imprenta monterrey, imprenta san pedro garza garcia, impresión apodaca nuevo leon, impresión guadalupe nuevo leon, impresión san nicolas nuevo leon, soluciones visuales monterrey">

<meta name="author"  content="VillArte">
<meta name="robots"  content="index, follow">
<link rel="canonical" href="https://www.villarte.qlynk.mx/">

<meta property="og:title"       content="VillArte | Impresión y Soluciones Visuales en Monterrey">
<meta property="og:description" content="Vinil impreso, etiquetas, lonas, banners y rotulación para tu empresa en Monterrey. Cotiza: 8126194101.">
<meta property="og:type"        content="website">
<meta property="og:url"         content="https://www.villarte.qlynk.mx/">
<meta property="og:image"       content="https://www.villarte.qlynk.mx/img/LogoVillArte1.png">
<meta property="og:locale"      content="es_MX">

<script type="application/ld+json">
{
  "@context":"https://schema.org",
  "@type":"LocalBusiness",
  "name":"VillArte Impresión y Soluciones Visuales",
  "image":"https://www.villarte.qlynk.mx/img/LogoVillArte1.png",
  "url":"https://www.villarte.qlynk.mx",
  "telephone":"+528126194101",
  "address":{"@type":"PostalAddress","addressLocality":"Monterrey","addressRegion":"Nuevo León","addressCountry":"MX"},
  "description":"Especialistas en vinil impreso, etiquetas, lonas, banners y rotulación en Monterrey y área metropolitana."
}
</script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>
/* ═══════════════════════════════════════════════════════
   CSS ORIGINAL — style.css (trash) embebido completo
═══════════════════════════════════════════════════════ */

:root{
--bg:#050505;
--card:#101010;
--text:#ffffff;
--blue:#00B6FF;
--purple:#8E4BFF;
--pink:#FF2D8D;
--orange:#FF8A00;
--gradient:linear-gradient(135deg,var(--blue),var(--purple),var(--pink),var(--orange));
}

*{margin:0;padding:0;box-sizing:border-box;}

html{scroll-behavior:smooth;}

body{
background:var(--bg);
color:var(--text);
font-family:'Poppins',sans-serif;
line-height:1.6;
}

.container{
width:min(1200px,90%);
margin:auto;
}

.header{
position:fixed;
top:0;
left:0;
width:100%;
background:rgba(5,5,5,.85);
backdrop-filter:blur(15px);
z-index:999;
}

.header .container{
display:flex;
justify-content:space-between;
align-items:center;
padding:18px 0;
}

.logo img{height:60px;}

.nav{display:flex;gap:30px;}

.nav a{
color:white;
text-decoration:none;
font-weight:500;
transition:.3s;
}

.nav a:hover{color:var(--blue);}

.btn-header{
padding:12px 24px;
border-radius:50px;
background:var(--gradient);
color:white;
text-decoration:none;
font-weight:600;
}

.hero{
min-height:100vh;
display:flex;
align-items:center;
justify-content:center;
text-align:center;
padding-top:120px;
}

.hero-content{max-width:900px;}

.hero-badge{
display:inline-block;
padding:10px 20px;
border-radius:50px;
background:#121212;
border:1px solid #222;
margin-bottom:25px;
}

.hero h1{
font-size:4rem;
line-height:1.1;
margin-bottom:20px;
}

.hero h2{
font-size:1.8rem;
font-weight:400;
margin-bottom:25px;
}

.hero p{
font-size:1.15rem;
color:#bdbdbd;
margin-bottom:40px;
}

.hero-services{
display:flex;
justify-content:center;
flex-wrap:wrap;
gap:15px;
margin:40px 0;
}

.hero-services span{
padding:12px 20px;
border-radius:999px;
background:#101010;
border:1px solid rgba(255,255,255,.08);
font-weight:600;
background-image:linear-gradient(135deg,#00B6FF,#8E4BFF,#FF2D8D,#FF8A00);
-webkit-background-clip:text;
-webkit-text-fill-color:transparent;
}

.hero-buttons{
display:flex;
justify-content:center;
gap:20px;
}

.btn-primary{
padding:16px 32px;
border-radius:50px;
background:var(--gradient);
color:white;
text-decoration:none;
font-weight:600;
}

.btn-secondary{
padding:16px 32px;
border-radius:50px;
border:1px solid #333;
color:white;
text-decoration:none;
}

/* Cards section original — ahora 5 columnas */
.cards-section{padding:100px 0;}

.cards-section .container{
display:grid;
grid-template-columns:repeat(5,1fr);
gap:25px;
}

.service-card{
background:var(--card);
padding:35px;
border-radius:24px;
transition:.3s;
}

.service-card:hover{transform:translateY(-8px);}

.service-card h3{
font-size:1.5rem;
margin-bottom:15px;
background:var(--gradient);
-webkit-background-clip:text;
-webkit-text-fill-color:transparent;
}

.service-card p{color:#bdbdbd;}

/* Workflow — clases originales */
.workflow{padding:120px 0;}

.section-title{
text-align:center;
margin-bottom:80px;
}

.section-title span{
letter-spacing:2px;
font-size:.85rem;
color:#FF2D8D;
font-weight:700;
}

.section-title h2{
font-size:3rem;
margin-top:10px;
}

.workflow-steps{
display:grid;
grid-template-columns:repeat(5,1fr);
gap:25px;
margin-bottom:60px;
}

.step{text-align:center;}

.step-number{
width:60px;
height:60px;
margin:auto;
margin-bottom:20px;
border-radius:50%;
display:flex;
align-items:center;
justify-content:center;
font-weight:700;
background:#101010;
border:1px solid #222;
}

.success{
background:linear-gradient(135deg,#FF2D8D,#FF8A00);
color:white;
}

.step h3{
margin-bottom:10px;
font-size:1.2rem;
}

.step p{
color:#9f9f9f;
font-size:.95rem;
}

.step-highlight h3{
background:linear-gradient(135deg,#FF2D8D,#FF8A00);
-webkit-background-clip:text;
-webkit-text-fill-color:transparent;
}

.workflow-benefits{
display:grid;
grid-template-columns:repeat(3,1fr);
gap:25px;
}

.benefit-card{
background:#101010;
padding:30px;
border-radius:20px;
border:1px solid #1f1f1f;
}

.benefit-card h4{
margin-bottom:10px;
font-size:1.2rem;
}

.benefit-card p{color:#bdbdbd;}

/* ═══════════════════════════════════════════════════════
   SECCIÓN CONTACTO — mismo look que el resto
═══════════════════════════════════════════════════════ */
.contact-section{
padding:120px 0;
background:var(--bg);
}

.contact-grid{
display:grid;
grid-template-columns:1fr 1.6fr;
gap:70px;
align-items:start;
}

.contact-info h3{
font-size:1.8rem;
font-weight:700;
margin-bottom:16px;
}

.contact-info > p{
color:#bdbdbd;
font-size:1rem;
margin-bottom:40px;
line-height:1.7;
}

.contact-item{
display:flex;
align-items:center;
gap:16px;
margin-bottom:22px;
}

.ci-icon{
width:46px;height:46px;
border-radius:50%;
background:#101010;
border:1px solid #222;
display:flex;
align-items:center;
justify-content:center;
flex-shrink:0;
}

.ci-icon svg{width:20px;height:20px;}

.ci-text strong{
display:block;
font-size:.72rem;
color:#666;
letter-spacing:.5px;
text-transform:uppercase;
margin-bottom:3px;
}

.ci-text a,.ci-text span{
font-size:.95rem;
color:#fff;
text-decoration:none;
transition:.3s;
}

.ci-text a:hover{color:var(--blue);}

/* Form box */
.form-box{
background:#101010;
border:1px solid #1f1f1f;
border-radius:24px;
padding:45px 40px;
}

.form-box h3{
font-size:1.4rem;
font-weight:700;
margin-bottom:30px;
}

.fg{margin-bottom:18px;}

.fg label{
display:block;
font-size:.75rem;
font-weight:600;
color:#666;
letter-spacing:.5px;
text-transform:uppercase;
margin-bottom:7px;
}

.fg input,
.fg select,
.fg textarea{
width:100%;
background:#050505;
border:1px solid #222;
color:#fff;
padding:13px 16px;
border-radius:12px;
font-family:'Poppins',sans-serif;
font-size:.9rem;
outline:none;
transition:border-color .3s;
appearance:none;
-webkit-appearance:none;
}

.fg input:focus,
.fg select:focus,
.fg textarea:focus{border-color:var(--pink);}

.fg select option{background:#101010;}
.fg textarea{resize:vertical;min-height:110px;}

.fg-row{
display:grid;
grid-template-columns:1fr 1fr;
gap:16px;
}

.btn-form{
width:100%;
padding:16px 32px;
border-radius:50px;
background:var(--gradient);
color:white;
font-family:'Poppins',sans-serif;
font-size:1rem;
font-weight:600;
border:none;
cursor:pointer;
margin-top:10px;
transition:opacity .3s,transform .3s;
}

.btn-form:hover{opacity:.88;transform:translateY(-1px);}

.form-msg{
padding:15px 18px;
border-radius:14px;
font-size:.9rem;
font-weight:500;
margin-bottom:22px;
display:flex;
align-items:center;
gap:10px;
}

.form-msg.ok{
background:rgba(0,200,100,.08);
border:1px solid rgba(0,200,100,.25);
color:#00c864;
}

.form-msg.err{
background:rgba(255,45,141,.08);
border:1px solid rgba(255,45,141,.25);
color:var(--pink);
}

/* ═══════════════════════════════════════════════════════
   RESPONSIVE
═══════════════════════════════════════════════════════ */
@media(max-width:1100px){
  .cards-section .container{grid-template-columns:repeat(3,1fr);}
}

@media(max-width:900px){
  .hero h1{font-size:2.8rem;}
  .cards-section .container{grid-template-columns:repeat(2,1fr);}
  .nav{display:none;}
  .workflow-steps{grid-template-columns:1fr;}
  .workflow-benefits{grid-template-columns:1fr;}
  .hero-services{justify-content:center;}
  .contact-grid{grid-template-columns:1fr;gap:40px;}
  .fg-row{grid-template-columns:1fr;}
}

@media(max-width:600px){
  .cards-section .container{grid-template-columns:1fr 1fr;}
  .form-box{padding:30px 22px;}
}
</style>

</head>

<body>

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

<!-- ════════════════════ HERO ════════════════════ -->
<section class="hero" id="inicio">

<div class="container">

<div class="hero-content">

<span class="hero-badge">

SOLUCIONES VISUALES

</span>

<h1>

IMPRESIÓN Y
SOLUCIONES VISUALES

</h1>

<h2>

Impulsamos la imagen
de tu negocio con
impresión profesional

</h2>

<p>

Vinil Impreso •
Etiquetas •
Lonas •
Banners •
Señalización •
Rotulación •
Material Corporativo

</p>

<div class="hero-buttons">

<a href="#contacto" class="btn-primary">

Solicitar Cotización

</a>

<a href="#galeria" class="btn-secondary">

Ver Trabajos

</a>

</div>

</div>

</div>

</section>

<!-- ════════════ SEGMENTOS (5 cards horizontal) ════════════ -->
<section class="cards-section" id="segmentos">

<div class="container">

<div class="service-card" id="empresas">
<h3>Empresas</h3>
<p>Kits corporativos,
gafetes,
reconocimientos,
señalización interna,
banners y material de RRHH.</p>
</div>

<div class="service-card" id="negocios">
<h3>Negocios</h3>
<p>Etiquetas,
stickers,
vinil para escaparates,
microperforado,
lonas y publicidad.</p>
</div>

<div class="service-card" id="restaurantes">
<h3>Restaurantes</h3>
<p>Menús,
murales,
promociones,
displays de mostrador
y rotulación.</p>
</div>

<div class="service-card" id="profesionales">
<h3>Profesionales</h3>
<p>Odontólogos,
médicos,
abogados,
arquitectos
y consultorios.</p>
</div>

<div class="service-card" id="hogar">
<h3>Hogar</h3>
<p>Vinilos decorativos,
cuadros impresos,
murales personalizados
y señalización
para tu espacio.</p>
</div>

</div>

</section>

<!-- ════════════ NUESTRA FORMA DE TRABAJO ════════════ -->
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

<!-- ════════════ GALERÍA (placeholder) ════════════ -->
<section id="galeria"></section>

<!-- ════════════ SOLICITAR INFORMACIÓN ════════════ -->
<section class="contact-section" id="contacto">

<div class="container">

<div class="section-title">
<span>COTIZA SIN COSTO</span>
<h2>Solicitar Información</h2>
</div>

<div class="contact-grid">

<!-- Datos -->
<div class="contact-info">

<h3>Hablemos de<br>tu proyecto</h3>

<p>Somos especialistas en impresión y soluciones visuales en Monterrey y toda el área metropolitana. Contáctanos y recibe una cotización personalizada sin costo.</p>

<div class="contact-item">
<div class="ci-icon">
<svg viewBox="0 0 24 24" fill="none" stroke="#00B6FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
<path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81a19.79 19.79 0 01-3.07-8.68A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92v2z"/>
</svg>
</div>
<div class="ci-text">
<strong>Teléfono</strong>
<a href="tel:+528126194101">81 2619 4101</a>
</div>
</div>

<div class="contact-item">
<div class="ci-icon">
<svg viewBox="0 0 24 24" fill="none" stroke="#8E4BFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
<path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/>
</svg>
</div>
<div class="ci-text">
<strong>Correo</strong>
<a href="mailto:info@villarte.qlynk.mx">info@villarte.qlynk.mx</a>
</div>
</div>

<div class="contact-item">
<div class="ci-icon">
<svg viewBox="0 0 24 24" fill="none" stroke="#FF2D8D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/>
</svg>
</div>
<div class="ci-text">
<strong>Ubicación</strong>
<a href="https://maps.google.com/?q=Monterrey,+Nuevo+León" target="_blank" rel="noopener">Monterrey, Nuevo León</a>
</div>
</div>

</div>

<!-- Formulario -->
<div class="form-box">

<h3>Envíanos un mensaje</h3>

<?php if ($form_success): ?>
<div class="form-msg ok">
<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
Mensaje enviado exitosamente. ¡Pronto nos pondremos en contacto contigo!
</div>
<?php else: ?>

<?php if ($form_error): ?>
<div class="form-msg err">
<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
<?= $form_error ?>
</div>
<?php endif; ?>

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
$opts = ['Vinil Impreso','Etiquetas / Stickers','Lonas y Banners',
         'Rotulación Vehicular','Señalización','Material Corporativo',
         'Mural / Decorativo','Microperforado','Hogar / Decoración','Otro'];
foreach ($opts as $o):
  $sel = (($_POST['service'] ?? '') === $o) ? 'selected' : '';
?>
<option value="<?= $o ?>" <?= $sel ?>><?= $o ?></option>
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

<button type="submit" class="btn-form">Enviar Mensaje</button>

</form>
<?php endif; ?>

</div>

</div><!-- /contact-grid -->

</div>

</section>

<script>console.log("VillArte iniciado");</script>

</body>
</html>
