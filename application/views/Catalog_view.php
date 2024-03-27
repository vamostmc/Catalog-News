<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.css">
	
	<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.js"></script>
	<link rel="stylesheet" href="<?php echo base_url(); ?>font_awe/css/all.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	

	<title>Danh mục tin</title>
</head>


<body>
	 	<div class="container">
			<div class="row">
				
				<div class="col-sm-7">
					<div class="text-center">
						<h3 class="display-3">Thêm tin tức</h3>	
					</div>
					<!-- <form method="POST" action="Home/AddNew" enctype="multipart/form-data"> -->
						<fieldset class="form-group" style="margin-bottom: 12px">
							<label for="title" >Tiêu đề tin tức</label>
							<input type="text" name="title" class="form-control" id="title" placeholder="Tiêu đề" >
						</fieldset>

						<fieldset class="form-group" style="margin-bottom: 12px">
							<label for="description">Mô tả tin tức</label>
							<input type="text" name="description" class="form-control" id="description" placeholder="Mô tả">
						</fieldset>

						<br>
						<fieldset class="form-group text-center">
							<input type="button" value="Gửi" class="btn btn-primary" id="themdanhmuc" placeholder="Mô tả">
						</fieldset>
					<!-- </form> -->
				</div>

				<div class="col-sm-5 danhmuc">
					<div class="text-center">
						<h2 class="display-3">Danh mục</h3>	
					</div>
					<!-- <?php echo base_url() ?>Home/DeleteNew/<?= $value['id'] ?> -->
					<div class="card bg-light tongquan" style="max-width: 35rem;">
						<div class="card-header" >Mục lục</div>
							<?php foreach ($ShowTin as $key=>$value): ?>
							  	<div class="card-body d-flex align-items-center jquery_hidden">
								    <h5 class="card-title mb-0 ndungsua-<?= $value['id'] ?>" ><?= $value['tieude'] ?></h5>
								    <a class="btn btn-primary nutedit" style="margin-left: auto;margin-right: 5px;" data-href="<?= $value['id'] ?>"><i class="fas fa-edit"></i> Edit</a>
								    <a class="btn btn-primary ml-4 nutxoa" data-href="<?= $value['id'] ?>"> <i class="fas fa-trash"></i> Delete</a>
								  </div>

								  <div class="jquery_but card-body d-flex align-items-center d-sm-none">

								    <fieldset class="form-group jquery_td">
                      <input type="hidden" class="form-control id" " value="<?= $value['id'] ?>" id="tendmsua" placeholder="Example input">
                      <input type="text" class="form-control tendmsua" style="width: 350px;" value="<?= $value['tieude'] ?>" id="tendmsua" placeholder="Example input">
                    </fieldset>

                    <a class="btn btn-primary nutluu" style="margin-left: auto;margin-right: 5px;" href="#"><i class="fa fa-check"></i> Lưu </a>
								  </div>

							<?php endforeach ?>
								
					</div>
				</div>
			</div>
		</div>

		<script>
			$(function() {

				var path = '<?php echo base_url() ?>' ;
				$('#themdanhmuc').click(function(event) {
					/* Act on the event */
				
					$.ajax({
						url: 'Home/AddNew_jquery',
						type: 'POST',
						dataType: 'json',
						data: {tendm: $('#title').val(), mota: $('#description').val() },
					})
					.done(function() {
						// console.log("success");
					})
					.fail(function() {
						// console.log("error");
					})
					.always(function(res) {
						console.log(res);

						//dung jquey de ve ra noi dung moi
						noidung = '<div class="card-body d-flex align-items-center jquery_hidden">';
						noidung += '<h5 class="card-title mb-0 ndungsua-'+ res +'" >' + $('#title').val() + '</h5>';
						noidung += '<a class="btn btn-primary nutedit" style="margin-left: auto;margin-right: 5px;" data-href="'+ res +'"><i class="fas fa-edit"></i> Edit</a>';
						noidung += '<a class="btn btn-primary ml-4 nutxoa" data-href="'+ res +'"><i class="fas fa-trash"></i> Delete</a>';
						noidung += '</div>';
						noidung += '</div>';
            noidung += '<div class="jquery_but card-body d-flex align-items-center d-sm-none">';

            noidung += '<fieldset class="form-group jquery_td">';
            noidung += '<input type="hidden" class="form-control id" " value="'+ res +'" id="tendmsua" placeholder="Example input">';
            noidung += '<input type="text" class="form-control tendmsua" style="width: 350px;" value="' + $('#title').val() + '" id="tendmsua" placeholder="Example input">';
            noidung += '</fieldset>';
            noidung += '<a class="btn btn-primary nutluu" style="margin-left: auto;margin-right: 5px;" href="#"><i class="fa fa-check"></i> Lưu </a>';
            noidung += '</div>';

						$('.tongquan').append(noidung);
						$('#title').val('');
						$('#description').val('');
					});
						

				});
        $('body').on('click', '.nutedit', function(event) {
          // Ẩn tác vụ ban đầu
          $(this).parent().addClass('d-sm-none');

          // Hiện tác vụ ẩn lên
          $(this).parent().next().removeClass('d-sm-none');
        });


        // Thao tác nút lưu sau khi edit
        $('body').on('click', '.nutluu', function(event) {

            // Lấy giá trị tiêu đề cần sửa
            var gtri = $(this).parent().children().find('.tendmsua').val();

            // Lấy id của tiêu đề sửa đó
            var id = $(this).parent().children().find('.id').val();
            console.log(id);

            // Ẩn tác vụ của mục edit sau khi lưu
            var ndedit = $(this).parent().parent().children('.jquery_but').addClass('d-sm-none');

            // Lấy giá trị sau khi sửa 
            var ndung = $(this).parent().children().find('.tendmsua').val();
            
            console.log(ndung);
            
            // Truyền giá trị sau khi sửa vào mục ban đầu
            var hienthi2 = $(this).parent().parent().find('.jquery_hidden').children('.ndungsua-' + id).html(ndung);
            
            // Cho hiện lại tác vụ như ban đầu mặc định
            var hienthi1 = $(this).parent().parent().children('.jquery_hidden').removeClass('d-sm-none');
            

            $.ajax({
              url: path + '/Home/UpdateNew_jquery/',
              type: 'POST',
              dataType: 'json',
              data: {tendmsua: gtri, id_edit: id},
            })
            .done(function() {
              console.log("success");
            })
            .fail(function() {
              console.log("error");
            })
            .always(function() {
              console.log("complete");
            });
            
        });
       


        // Xóa những phần tử có sẵn ban đầu
				$('body').on('click', '.nutxoa', function(event) {
          event.preventDefault();
					id_xoa = $(this).data('href');
					dtxoa = $(this).parent();
					console.log(id_xoa);

					$.ajax({
						url: path + 'Home/DeleteNew/' + id_xoa,
						type: 'POST',
						dataType: 'json',
						
					})
					.done(function() {
						console.log("success");
					})
					.fail(function() {
						console.log("error");
					})
					.always(function() {
						console.log("complete");
						dtxoa.remove();
					});
				});

      

			})
	
		</script>

</body>
</html>