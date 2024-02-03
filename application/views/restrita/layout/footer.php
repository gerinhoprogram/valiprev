      <?php if ($this->router->fetch_class() != 'login') : ?>

      	<?php if (class_exists($this->router->fetch_class())) : ?>

      		<footer class="main-footer">
      			<div class="footer-left">
      				<a href="<?= base_url('restrita/home') ?>">NCWBrasil</a></a>
      			</div>
      			<div class="footer-right">
      			</div>
      		</footer>

      	<?php endif; ?>
      <?php endif; ?>


      </div>
      </div>

      <script>
      	const BASE_URL = '<?php echo base_url() ?>';
      </script>
      <script src="<?php echo base_url('public/restrita/assets/js/app.min.js'); ?>"></script>
      <script src="<?php echo base_url('public/restrita/assets/js/scripts.js'); ?>"></script>
      <script src="<?php echo base_url('public/restrita/assets/js/custom.js'); ?>"></script>
      <script src="<?php echo base_url('public/restrita/assets/bootbox/bootbox.min.js'); ?>"></script>
      <script src="<?= base_url('public/restrita/assets/bundles/izitoast/js/iziToast.min.js') ?>"></script>

      <?php if (isset($scripts)) : ?>
      	<?php foreach ($scripts as $script) : ?>
      		<script src="<?php echo base_url('public/restrita/' . $script); ?>"></script>
      	<?php endforeach; ?>
      <?php endif; ?>

      <div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      	<div class="modal-dialog" role="document">
      		<div class="modal-content">
      			<div class="modal-header">
      				<h5 class="modal-title" id="exampleModalLabel">Deseja sair do sistema?</h5>
      				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
      					<span aria-hidden="true">&times;</span>
      				</button>
      			</div>
      			<div class="modal-body">

      			</div>
      			<div class="modal-footer bg-whitesmoke br">
      				<a href="<?php echo base_url('restrita/login/logout'); ?>">
      					<button type="button" class="btn btn-danger">Sair</button>
      				</a>
      				<button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
      			</div>
      		</div>
      	</div>
      </div>


      <script>
      	function loading() {
      		$('#loading').html('<div class="loader2"></div>');
      	}


      	function loading_2() {
      		document.querySelector("[name='visu']").value = 1;
      		$('#loading').html('<div class="loader2"></div>');

      	}

      	function loading_3() {
      		document.querySelector("[name='salvar']").value = 1;
      		$('#loading').html('<div class="loader2"></div>');

      	}

      	function loading_save() {
      		iziToast.warning({
      			title: 'Aguarde!',
      			message: 'Estamos validando os dados!',
      			position: 'topCenter'
      		});
      		$('.modal').css('display', 'none');
      		$('#loading').html('<div class="loader2"></div>');
      	}

      	$('.delete').on("click", function(event) {

      		event.preventDefault();

      		var redirect = $(this).attr('href');

      		bootbox.confirm({
      			title: $(this).attr('data-confirm'),
      			centerVertical: true,
      			message: "<p class='text-danger'>Esta ação não poderá ser desfeita!</p>",
      			buttons: {
      				confirm: {
      					label: 'Excluir',
      					className: 'btn-danger'
      				},
      				cancel: {
      					label: 'Cancelar',
      					className: 'btn-primary'
      				}
      			},
      			callback: function(result) {

      				if (result) {
      					iziToast.warning({
      						title: 'Aguarde!',
      						message: 'Estamos deletando os dados!',
      						position: 'topCenter'
      					});
      					$('#loading').html('<div class="loader2"></div>');
      					window.location.href = redirect;
      				}




      			}
      		});

      	});



      	$('.situacao').on("click", function(event) {

      		event.preventDefault();

      		var redirect = $(this).attr('href');

      		bootbox.confirm({
      			title: $(this).attr('data-confirm'),
      			centerVertical: true,
      			message: "<p class='text-danger'></p>",
      			buttons: {
      				confirm: {
      					label: 'Confirmar',
      					className: 'btn-success'
      				},
      				cancel: {
      					label: 'Cancelar',
      					className: 'btn-primary'
      				}
      			},
      			callback: function(result) {

      				if (result) {
      					iziToast.warning({
      						title: 'Aguarde!',
      						message: 'Estamos atualizando os dados!',
      						position: 'topCenter'
      					});
      					$('#loading').html('<div class="loader2"></div>');
      					window.location.href = redirect;
      				}




      			}
      		});

      	});
      </script>
      <?php if ($mensagem = $this->session->flashdata('sucesso')) {
			echo "<script>
				iziToast.success({
				title: 'Ok!',
				message: '" . $mensagem . "',
				position: 'topCenter'
			});</script>";
			$_SESSION['sucesso'] = null;
		} ?>

      <?php if ($mensagem = $this->session->flashdata('erro')) {

			echo "<script>
        iziToast.error({
        title: 'Erro!',
        message: '" . $mensagem . "',
        position: 'topCenter'
      });</script>";
	  $_SESSION['erro'] = null;
		} ?>

      </body>

      </html>
