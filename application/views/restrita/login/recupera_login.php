<section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="card card-primary">
              <div class="card-header">
                <h4><?=$titulo?></h4>
              </div>
              <div class="card-body">
                <p class="text-muted">Digite seu e-mail para receber os próximos passos.</p>
                <form method="POST" action="<?php echo base_url('restrita/login/envia_recupera_login'); ?>" >
                  <div class="form-group">
                    <label for="email">*Seu e-mail</label>
                    <input type="email" autofocus class="form-control" name="email" tabindex="1" required >
                    <?php echo form_error('email', '<div class="text-danger">', '</div>'); ?>  
                </div>
                  
                  
                  <div class="form-group">
                    <button onclick="loading_save()" type="submit" class="btn btn-success btn-lg btn-block" tabindex="4">
                      Enviar e-mail
                    </button>
                  </div>
                  
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>