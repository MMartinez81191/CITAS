<?php
    $usuario = $this->session->userdata('usuario');
    $id_usuario = $this->session->userdata('id_usuario');
    $nombre = $this->session->userdata('nombre').' '.$this->session->userdata('apellido_p').' '.$this->session->userdata('apellido_m');
    $nivel = $this->session->userdata('nivel');

?>

<header class="main-header">
    <a  href="<?=base_url()?>index.php/main" class="logo"> 
        <span class="logo-mini"><b>Citas</b></span>
        <span class="logo-lg"><b>BIENVENIDO</b></span>
    </a>
	<div id ="logo">
	</div>
    <nav class="navbar navbar-static-top navbar navbar-light">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a> 
        <div class="navbar-custom-menu navbar navbar-light">
            <ul class="nav navbar-nav navbar navbar-light">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <span class="hidden-xs"><?php echo $nombre; ?></span></a>

                    <ul class="dropdown-menu">
                        <li class="user-header" style="height: 125px">
                            <p>
                                <br>Usuario: <?php echo $usuario; ?>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <button data-toggle="modal" data-target="#modal_modificar_pass" class="btn btn-default btn-flat">Contraseña</button>
                            </div>
                            <div class="pull-right">
                                <a href="<?=site_url()?>main/logout" class="btn btn-default btn-flat">Cerrar Sesion</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>

<!-- MODAL PARA EDITAR LA CONTRASEÑA -->
<div class="modal fade" id="modal_modificar_pass" tabindex="-1" role="dialog" aria-hidden="true" >
    <div class="modal-dialog" style="width: 40%;">
        <div class="modal-content animated bounceInRight" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Modificar Contraseña</h4>
            </div>
            <div class="modal-body">
                <form name="modificar_contrasena" id="modificar_contrasena"> 
                    <input type="hidden" value="<?=$id_usuario?>" name="id_usuario" id="id_usuario">
                    <div class="row">
                        <div class="form-group col-md-8 col-md-offset-2">
                            <label>Nombre Usuario:</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese su nombre de usuario" value="<?=$nombre?>" maxlength="100" onKeyUp="this.value=this.value.toUpperCase();" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-8 col-md-offset-2">
                            <label>Constraseña Nueva:</label>
                            <input type="password" class="form-control" name="nueva" id="nueva" placeholder="Ingrese su Contraseña" maxlength="25" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-8 col-md-offset-2">
                            <label>Confirmar Constraseña:</label>
                            <input type="password" class="form-control" name="confirmacion" id="confirmacion" placeholder="Ingrese su Contraseña" maxlength="25" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary shadow p-3 mb-5 bg-white rounded">Enviar</button>
                        <button type="button" class="btn btn-white shadow p-3 mb-5 bg-white rounded" data-dismiss="modal">Cancelar</button>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>
<!-- FIN DEL MODAL PARA EDITAR LA CONTRASEÑA -->



<aside class="main-sidebar" >
    <section class="sidebar">
        <!-- PANEL DE ADMINISTRACION -->
        <ul class="sidebar-menu tree" data-widget="tree">
            <?php
            if($nivel < 3)
            {
            ?> 
            <li class="treeview" >
                <a href="#"><i class="fa fa-gears"></i><span>Administrar</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                <ul class="treeview-menu">
                <?php
                if($nivel != 3)
                {
                ?>
                    <li><a href="<?=base_url()?>index.php/usuarios"><i class="fa fa-user-plus"></i> Cuentas de Usuarios</a></li>
                <?php
                }
                ?>
                    <li><a href="<?=base_url()?>index.php/costos"><i class="fa fa-money"></i> Costos de Consultas</a></li>
                </ul>
            </li>
            <?php
            }
            ?>
            <?php
            if($nivel != 3)
            {
            ?>
            <li class="treeview" >
                <li><a href="<?=base_url()?>citas"><i class="fa fa-calendar-check-o"></i><span>Citas</span></a></li>
            </li>
            <li class="treeview" >
                <li><a href="<?=base_url()?>clientes"><i class="fa fa-users"></i><span>Pacientes</span></a></li>
            </li>
            <?php
            }
            ?>
            <?php
            if($nivel <= 3 or $nivel == 5)
            {
            ?>
            <li class="treeview" >
                <li><a href="<?=base_url()?>corte"><i class="fa fa-money"></i><span>Corte de Caja</span></a></li>
            </li>
            <?php
            }
            ?>
            
            <?php
            if($nivel <= 3)
            {
            ?>
            <li class="treeview" >
                <li><a href="<?=base_url()?>Corte_Parcial"><i class="fa fa-money"></i><span>Cortes Parciales</span></a></li>
            </li>
            <?php
            }
            ?>
        </ul>
    </section>
</aside>

