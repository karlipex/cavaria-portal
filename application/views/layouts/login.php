<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="es-CL">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $this->layout->getTitle(); ?></title>    
    <meta name="description" content="<?php echo $this->layout->getDescripcion(); ?>">
    <meta name="keywords" content="<?php echo $this->layout->getKeywords(); ?>" />
    <link rel="shorcut icon" href="<?php echo base_url()?>public/img/favicon.jpg">
    <link href="https://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:100,200,300,400" rel="stylesheet">
    
<!--*************auxiliares*****************-->

<?php echo $this->layout->css; ?> 

<?php echo $this->layout->js; ?> 

<!--**********fin auxiliares*****************-->
</head>
<body>
     <?php echo $content_for_layout; ?>
</body>
</html>