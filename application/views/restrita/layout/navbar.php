<div class="navbar-bg"></div>
<?php  $usuario = usuarios($_SESSION['user_id']);  ?>
<nav class="navbar navbar-expand-lg main-navbar sticky menu-topo">
    <div class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">

        <li>
            
                
                <div class="selectgroup layout-color">
                    <label class="selectgroup-item">
                        <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" <?=($usuario->email_ativacao == 1 ? 'checked' : '')?>>
                        <span class="selectgroup-button"><i class="fas fa-sun"></i></span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout" <?=($usuario->email_ativacao == 2 ? 'checked' : '')?>>
                        <span class="selectgroup-button"><i class="fas fa-moon"></i></span>
                    </label>
                </div>
            </li> 

        <li data-toggle="tooltip" data-placement="top" title="Dashboard"><a href="<?php echo base_url('restrita') ?>" onclick="loading()" class="nav-link nav-link-lg
									collapse-btn"> <i class="text-info" data-feather="home"></i></a>
            </li>
           
            <li data-toggle="tooltip" data-placement="top" title="Meu perfil"><a href="<?php echo base_url('restrita/usuarios/core/').$_SESSION['user_id'] ?>" onclick="loading()" class="nav-link nav-link-lg
									collapse-btn"> <i class="text-info" data-feather="user-check"></i></a>
            </li>
            <li data-toggle="tooltip" data-placement="top" title="Alterar senha"><a href="<?php echo base_url('restrita/usuarios/password/').$_SESSION['user_id'] ?>" onclick="loading()" class="nav-link nav-link-lg
									collapse-btn"> <i class="text-info" data-feather="lock"></i></a>
            </li>

            
            <li data-toggle="tooltip" data-placement="top" title="Encolher menu lateral"><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i class="text-warning" data-feather="align-justify"></i></a>
            </li>
            <li data-toggle="tooltip" data-placement="top" title="Tela fullscreen"><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                <i class="text-warning" data-feather="maximize"></i>
              </a>
            </li>
            
            <li data-toggle="tooltip" data-placement="top" title="Sair do sistema"><a href="javascript:;" data-toggle="modal" data-target="#basicModal" class="nav-link nav-link-lg
									collapse-btn"> <i class="text-danger" data-feather="log-out"></i></a>
            </li>
        </ul>
    </div>
    
</nav>