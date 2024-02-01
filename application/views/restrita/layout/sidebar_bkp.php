<?php $sistema = info_header_footer(); ?>
<?php $user = $this->ion_auth->user()->row();
$acessos = area_acesso();

echo"<pre>";
print_r($acessos);
exit();

?>
<div class="main-sidebar sidebar-style-2" style="overflow: hidden; outline: none; cursor: auto; touch-action: auto;">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand bg-white">
            <a href="<?php echo base_url('restrita'); ?>"> <img alt="image" src="<?php echo base_url('uploads/sistema/logo/'.$sistema->sistema_logo); ?>" class="header-logo" />
            </a>
        </div>
        <ul class="sidebar-menu">

            <li class="dropdown <?php echo ($this->router->fetch_class() == 'artigos' ? 'active' : '') ?>">
                <a onclick="loading()" href="<?php echo base_url('restrita/artigos'); ?>" class="nav-link"><i data-feather="tag"></i><span>Artigos</span></a>
            </li>

            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="briefcase"></i><span>Categorias</span></a>
                <ul class="dropdown-menu">
                    <li><a onclick="loading()" class="nav-link" href="<?php echo base_url('restrita/master'); ?>">Categorias pai</a></li>
                    <li><a onclick="loading()" class="nav-link" href="<?php echo base_url('restrita/categorias'); ?>">Categorias filhas</a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="image"></i><span>Banners CTA</span></a>
                <ul class="dropdown-menu">
                    <li><a onclick="loading()" class="nav-link" href="<?php echo base_url('restrita/banners_cta'); ?>">Gerenciar</a></li>
                    <li><a onclick="loading()" class="nav-link" href="<?php echo base_url('restrita/banners_cta/view'); ?>">Visualizar</a></li>
                </ul>
            </li>

            <li class="dropdown <?php echo ($this->router->fetch_class() == 'icones' ? 'active' : '') ?>">
                <a onclick="loading()" href="<?php echo base_url('restrita/icones'); ?>" class="nav-link"><i data-feather="box"></i><span>Ícones</span></a>
            </li>
            
            <hr>

            <li class="dropdown <?php echo ($this->router->fetch_class() == 'sistema' ? 'active' : '') ?>">
                <a onclick="loading()" href="<?php echo base_url('restrita/sistema'); ?>" class="nav-link"><i data-feather="layout"></i><span>Informações blog</span></a>
            </li>

            <!-- <li class="dropdown <?php echo ($this->router->fetch_class() == 'banners_stie' ? 'active' : '') ?>">
                <a href="<?php echo base_url('restrita/banners_site'); ?>" class="nav-link"><i data-feather="settings"></i><span>Banners site</span></a>
            </li> -->

            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="image"></i><span>Banners blog</span></a>
                <ul class="dropdown-menu">
                    <li><a onclick="loading()" class="nav-link" href="<?php echo base_url('restrita/banners_site'); ?>">Gerenciar</a></li>
                    <li class="dropdown">
                        <a href="#" class="menu-toggle nav-link has-dropdown"><span>Posições</span></a>
                        <ul class="dropdown-menu">
                            <li><a onclick="loading()" class="nav-link" href="<?php echo base_url('restrita/banners_site/posicoes/home'); ?>">Home</a></li>
                            <li><a onclick="loading()" class="nav-link" href="<?php echo base_url('restrita/banners_site/posicoes/categorias'); ?>">Outras páginas</a></li>
                            <li><a onclick="loading()" class="nav-link" href="<?php echo base_url('restrita/banners_site/posicoes/artigos'); ?>">Todos artigos</a></li>
                            <li><a onclick="loading()" class="nav-link" href="<?php echo base_url('restrita/banners_site/posicoes/artigo'); ?>">Artigo detalhe</a></li>
                        </ul>
                    </li>
                </ul>
            </li>

            <hr>

            <?php if ($this->ion_auth->is_admin()) :?>
            <li class="dropdown <?php echo ($this->router->fetch_class() == 'usuarios' ? 'active' : '') ?>">
                <a onclick="loading()" href="<?php echo base_url('restrita/usuarios'); ?>" class="nav-link"><i data-feather="users"></i><span>Usuários</span></a>
            </li>
            <?php else : ?>
                <li class="dropdown <?php echo ($this->router->fetch_class() == 'usuarios' ? 'active' : '') ?>">
                    <a onclick="loading()" href="<?php echo base_url('restrita/usuarios/core/' . $user->id); ?>" class="nav-link"><i data-feather="user"></i><span>Meus dados</span></a>
                </li>
            <?php endif ?>

            <!-- <li class="dropdown <?php echo ($this->router->fetch_class() == 'configuracoes' ? 'active' : '') ?>">
                    <a onclick="loading()" href="<?php echo base_url('restrita/configuracoes/'); ?>" class="nav-link"><i data-feather="settings"></i><span>Config. Painel</span></a>
            </li> -->

            <li class="dropdown <?php echo ($this->router->fetch_class() == 'login' ? 'active' : '') ?>">
                <a onclick="loading()" href="" data-toggle="modal" data-target="#basicModal" class="nav-link"><i data-feather="log-out"></i><span>Sair</span></a>
            </li>


        </ul>
    </aside>
</div>