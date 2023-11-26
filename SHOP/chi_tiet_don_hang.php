<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Hóa Đơn</title>
	<link href="https://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/invoice_detail.css">
</head>

<body>
	<div class="receipt-content">
		<div class="container bootstrap snippets bootdey">
			<div class="row">
				<div class="col-md-12">
					<div class="invoice-wrapper">
						<div class="intro" style="text-align: center;">
							<strong style="font-size: 2.5rem; font-weight: bold;">HÓA ĐƠN</strong>
						</div>
						<div class="payment-info">
							<div class="row">
								<div class="col-sm-6">
									<span>Mã Hóa Đơn</span>
									<strong>434334343</strong>
								</div>
								<div class="col-sm-6 text-right">
									<span>Ngày Tạo Đơn</span>
									<strong>26/11/2023 - 2:07 am</strong>
								</div>
							</div>
						</div>

						<div class="payment-details">
							<div class="row ">
								<div class="col-sm-6 mb-5">
									<span>Người Gửi</span>
									<strong>Family Shop</strong>
									<p>
										Cầu Giấy<br>
										Hà Nội <br>
										Việt Nam <br>
									</p>
								</div>
								<div class="col-sm-6 text-right mb-5">
									<span>Người Nhận</span>
									<strong>Minh Anh</strong>
									<p>
										TX. Thái Hòa <br>
										Nghệ An <br>
										Việt Nam <br>
									</p>
								</div>
							</div>
						</div>

						<div class="line-items">
							<div class="headers clearfix">
								<div class="row">
									<div class="col-xs-4">Chi Tiết Đơn Hàng</div>
									<div class="col-xs-3">Số Lượng</div>
									<div class="col-xs-5 text-right">Giá Tiền</div>
								</div>
							</div>
							<div class="items">
								<div class="row item">
									<div class="col-xs-4 desc">
										Áo phao ấm
									</div>
									<div class="col-xs-3 qty">
										1
									</div>
									<div class="col-xs-5 amount text-right">
										$60.00
									</div>
								</div>
								<div class="row item">
									<div class="col-xs-4 desc">
										Quần âu dáng Hàn Quốc
									</div>
									<div class="col-xs-3 qty">
										2
									</div>
									<div class="col-xs-5 amount text-right">
										$20.00
									</div>
								</div>

							</div>
							<div class="total text-right">
								<p class="extra-notes">
									<strong>Lưu Ý</strong>
									Nếu có vấn đề khi nhận đơn hàng vui lòng gửi yêu cầu trả hàng/hoàn tiền trong vòng 7
									ngày kể từ khi đơn hàng giao thành công. Cảm ơn quý khách!
								</p>
								<div class="field">
									Tổng Tiền Hàng <span>$379.00</span>
								</div>
								<div class="field">
									Phí Vận Chuyển <span>$0.00</span>
								</div>
								<div class="field">
									Giảm Giá <span>4.5%</span>
								</div>
								<div class="field grand-total" style="font-weight: bold;">
									TOTAL <span>$312.00</span>
								</div>
							</div>
						</div>
						<div class="footer">
							Copyright © 2023. Family Shop
						</div>
					</div>
				</div>
			</div>
		</div>


		<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
		<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
		<script src="https://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<script type="text/javascript"></script>

		<?php include 'includes/footer.php'; ?>

</body>


</html>