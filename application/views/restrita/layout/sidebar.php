<?php $sistema = info_header_footer(); ?>
<?php $user = $this->ion_auth->user()->row();

//$sidebar_sistema = sidebar_sistema($_SESSION['grupo_id']->grupo_id);

// echo"<pre>";
// print_r($user);
// exit;

?>
<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?php echo base_url('restrita'); ?>"> <img alt="image" src="<?php echo base_url('uploads/sistema/logo/' . $sistema->sistema_logo ); ?>" class="header-logo" />
            </a>
        </div>
        <ul class="sidebar-menu" style="overflow: auto; padding-bottom: 50px">


            <?php foreach (sidebar_sistema() as $menu) : ?>

                <?php if(!$menu->area_principal) :?>
                    
                    <li class="dropdown <?php echo ($this->router->fetch_class() == $menu->area_url ? 'active' : '') ?>">
                   
                    
                    <?php if ($menu->submenu == 1) : ?>

                        <a href="#" class="menu-toggle nav-link has-dropdown"><i class="<?=$menu->area_icone?>"></i><span><?= $menu->area_nome ?></span></a>
                        <ul class="dropdown-menu">
                            <?php foreach (sidebar_sub_sistema($menu->area_id) as $sub) { ?>
                                <li><a onclick="loading()" class="nav-link" href="<?php echo base_url('restrita/' . $sub->area_url); ?>"><?= $sub->area_nome ?></a></li>
                            <?php } ?>

                        </ul>

                    <?php else : ?>

                        <a onclick="loading()" href="<?php echo base_url('restrita/' . $menu->area_url); ?>" class="nav-link"><i class="<?=$menu->area_icone?>"></i><span><?= $menu->area_nome ?></span></a>

                    <?php endif ?>
                    </li>
                    <?php endif ?>


                <?php endforeach ?>


        </ul>
    </aside>
</div>
