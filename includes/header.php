<?php require_once 'php_action/core.php'; ?>
<!DOCTYPE html>
<html>
<head>

	<title>Sistema de Gestión de Inventario</title>

	<!-- bootstrap -->
	<link rel="stylesheet" href="assests/bootstrap/css/bootstrap.min.css">
	<!-- bootstrap theme-->
	<link rel="stylesheet" href="assests/bootstrap/css/bootstrap-theme.min.css">
	<!-- font awesome -->
	<link rel="stylesheet" href="assests/font-awesome/css/font-awesome.min.css">

  <!-- custom css -->
  <link rel="stylesheet" href="custom/css/custom.css">

	<!-- DataTables -->
  <link rel="stylesheet" href="assests/plugins/datatables/jquery.dataTables.min.css">

  <!-- file input -->
  <link rel="stylesheet" href="assests/plugins/fileinput/css/fileinput.min.css">

  <!-- jquery -->
	<script src="assests/jquery/jquery.min.js"></script>
  <!-- jquery ui -->  
  <link rel="stylesheet" href="assests/jquery-ui/jquery-ui.min.css">
  <script src="assests/jquery-ui/jquery-ui.min.js"></script>

  <!-- bootstrap js -->
	<script src="assests/bootstrap/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="assests/bootstrap/css/main.css" />

  <script>
    $(document).ready(function() {
         $('[data-toggle="tooltip"]').tooltip();

         $('.submenu-toggle').click(function () {
              $(this).parent().children('ul.submenu').toggle(200);
        });
    });
   </script>

  </head>
  <body>
    <header id="header">
      <div class="logo pull-left"><strong><?php echo date("d/m/Y");?></strong></div>
      <div class="header-content">
      <div class="pull-right clearfix">
        <ul class="info-menu list-inline list-unstyled">
          <li class="profile">
            <a href="#" data-toggle="dropdown" class="toggle" aria-expanded="false">
              <img src='assests/images/photo_default.png' alt="user-image" class="img-circle img-inline">
              <span>Automotriz El Sitio<i class="caret"></i></span>
            </a>
            <ul class="dropdown-menu">
            <li id="topNavSetting"><a href="setting.php"> <i class="glyphicon glyphicon-wrench"></i> Configuración</a></li>            
            <li id="topNavLogout"><a href="logout.php"> <i class="glyphicon glyphicon-log-out"></i> Salir</a></li>
           </ul>
          </li>
        </ul>
      </div>
     </div>
    </header>
    <div class="sidebar">
    <ul>        

<li id="navDashboard"><a href="index.php"><i class="glyphicon glyphicon-list-alt"></i>  Inicio</a></li>        

<li id="navBrand"><a href="brand.php"><i class="glyphicon glyphicon-wrench"></i>  Proveedores</a></li>        

<li id="navCategories"><a href="categories.php"> <i class="glyphicon glyphicon-th-list"></i> Categorías</a></li>        

<li id="navProduct"><a href="product.php"> <i class="glyphicon glyphicon-tasks"></i> Inventario </a></li>   

    <li id="navProduct"><a href="kardex.php"> <i class="glyphicon glyphicon-book"></i> Kardex </a></li>    

<li class="dropdown" id="navOrder">
  <a href="#" class="submenu-toggle"> <i class="glyphicon glyphicon-shopping-cart"></i> Ventas <span class="caret"></span></a>
  <ul class="nav submenu">            
    <li id="topNavAddOrder"><a href="addOrder.php"> Agregar Ventas</a></li>            
    <li id="topNavManageOrder"><a href="orders.php?o=manord"> Gestionar Ventas</a></li> 
    <li id="addOutlay"><a href="addOutlay.php"> Agregar credito Fiscal </a></li>  
  <li id="managerOutlay"><a href="outlay.php"> Gestionar credito fiscal </a></li>            
  </ul>
</li> 

<li class="dropdown" id="navOutlay">
  <a href="#" href="#" class="submenu-toggle"> <i class="glyphicon glyphicon-usd"></i> Compras <span class="caret"></span></a>
  <ul class="nav submenu">                       
  <li id="addOutlay"><a href="addOutlay.php"> Agregar compras </a></li>  
  <li id="managerOutlay"><a href="outlay.php"> Gestionar compras </a></li>            
  </ul>
</li> 

<li class="dropdown" id="navOutlay">
  <a href="#" href="#" class="submenu-toggle"> <i class="glyphicon glyphicon-retweet"></i> Devoluciones <span class="caret"></span></a>
  <ul class="nav submenu">                       
  <li id="addReturn"><a href="addReturn.php"> Agregar devolucion </a></li>  
  <li id="manageReturn"><a href="returns.php"> Gestionar devoluciones </a></li>           
  </ul>
</li> 

<li class="dropdown" id="navOutlay">
  <a href="#" href="#" class="submenu-toggle"> <i class="glyphicon glyphicon-file"></i> Cotizaciones <span class="caret"></span></a>
  <ul class="nav submenu">                       
  <li id="addQuotation"><a href="addQuotation.php"> Agregar Cotizacion </a></li>  
  <li id="manageQuotations"><a href="quotations.php"> Gestionar cotizaciones </a></li>           
  </ul>
</li> 

<li id="navProduct"><a href="costumers.php"> <i class="glyphicon glyphicon-user"></i> Clientes </a></li>  

<li id="navReport"><a href="accountsReceivable.php"> <i class="glyphicon glyphicon-save"></i> Cuentas por cobrar </a></li>

<li id="navReport"><a href="accountsPayable.php"> <i class="glyphicon glyphicon-open"></i> Cuentas por pagar </a></li> 

<li id="navReport"><a href="report.php"> <i class="glyphicon glyphicon-check"></i> Reportes </a></li>
       
</ul>
</div>

<div class="page">
  <div class="container-fluid">