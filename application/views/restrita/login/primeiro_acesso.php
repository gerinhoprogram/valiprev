<section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="card card-primary">
              <div class="card-header">
                <h4><?=$titulo?></h4>
              </div>
              <div class="card-body">
                <p class="text-muted">Para continuar, altere sua senha</p>
                <form method="POST" action="<?php echo base_url('restrita/login/ativar_senha'); ?>" >
                  <div class="form-group">
                    <label for="email">*Login</label>
                    <input id="email" value="<?=$usuario->email?>" readonly type="text" class="form-control" name="email" tabindex="1" required >
                    <?php echo form_error('email', '<div class="text-danger">', '</div>'); ?>  
                </div>
                  <div class="form-group">
                    <label for="password">*Nova senha</label>
                    <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator"
                      name="password" tabindex="2" placeholder="Mínimo 4 e máximo 15 caracteres" autofocus required max_length="15" min_length="4">
                    <div id="pwindicator" class="pwindicator">
                      <div class="bar"></div>
                      <div class="label"></div>
                    </div>
                    <?php echo form_error('password', '<div class="text-danger">', '</div>'); ?>

                  </div>
                  <div class="form-group">
                    <label for="password-confirm">*Confirma senha</label>
                    <input id="password-confirm" type="password" class="form-control" max_length="15" min_length="4" name="confirma_senha"
                      tabindex="2" required>
                      <?php echo form_error('confirma_senha', '<div class="text-danger">', '</div>'); ?>

                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-success btn-lg btn-block" tabindex="4">
                      Alterar
                    </button>
                  </div>
                  <input value="<?=$usuario->token?>" readonly type="hidden" name="token" required >

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>