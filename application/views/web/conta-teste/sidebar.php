<aside>

    <?php $anunciante = get_info_anunciante(); ?>

    <div class="sidebar-box">
        <div class="user">
            <figure>
                <img width="80" src="<?php echo base_url('uploads/usuarios/small/' . $anunciante->user_foto); ?>" alt="">
            </figure>
            <div class="usercontent">
                <h3><?php echo $anunciante->first_name . ' ' . $anunciante->last_name; ?></h3>
                <h4>Anunciante</h4>
            </div>
        </div>
        <nav class="navdashboard">
            <ul>
                <li>
                    <a class="<?php echo ($this->router->fetch_method() == 'index' ? 'active' : ''); ?>" href="<?php echo base_url('conta'); ?>">
                        <i class="lni-dashboard"></i>
                        <span>Início</span>
                    </a>
                </li>

                <li>
                    <a class="<?php echo ($this->router->fetch_method() == 'anuncios' ? 'active' : ''); ?>" href="<?php echo base_url('conta/anuncios'); ?>">
                        <i class="lni-layers"></i>
                        <span>Meus anúncios</span>
                    </a>
                </li>
                <li>
                    <a class="<?php echo ($this->router->fetch_method() == 'perguntas' ? 'active' : ''); ?>" href="<?php echo base_url('conta/perguntas'); ?>">
                        <i class="lni-envelope"></i>
                        <span>O que perguntaram</span>

                        <?php $perguntas_sem_respostas = get_perguntas_sem_resposta(); ?>


                        <?php if ($perguntas_sem_respostas > 0): ?>

                            <span class="badge badge-danger float-right blink_me" style="margin-top: 1.5em; margin-right: 2em;"><?php echo $perguntas_sem_respostas; ?></span>

                        <?php endif; ?>
                    </a>
                </li>


                <li>
                    <a class="<?php echo ($this->router->fetch_method() == 'duvidas' ? 'active' : ''); ?>" href="<?php echo base_url('conta/duvidas'); ?>">
                        <i class="lni-question-circle"></i>
                        <span>O que perguntei</span>
                    </a>
                </li>


                <li>
                    <a class="<?php echo ($this->router->fetch_method() == 'perfil' ? 'active' : ''); ?>" href="<?php echo base_url('conta/perfil/'); ?>">
                        <i class="lni-cog"></i>
                        <span>Gerenciar meus dados</span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo base_url('login/logout'); ?>">
                        <i class="lni-enter"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>