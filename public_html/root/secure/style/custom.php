<?php
$style_custom = "
@font-face {
	font-family: 'Roboto';
	font-style: normal;
	font-weight: 400;
	src: local(Roboto), local(Roboto-Regular), url(https://zrcdn.net/fonts/roboto/files/roboto_r_1.woff2) format('woff2');
	unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F
}
@font-face {
	font-family: 'Roboto';
	font-style: normal;
	font-weight: 400;
	src: local(Roboto), local(Roboto-Regular), url(https://zrcdn.net/fonts/roboto/files/roboto_r_2.woff2) format('woff2');
	unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116
}
@font-face {
	font-family: 'Roboto';
	font-style: normal;
	font-weight: 400;
	src: local(Roboto), local(Roboto-Regular), url(https://zrcdn.net/fonts/roboto/files/roboto_r_3.woff2) format('woff2');
	unicode-range: U+1F00-1FFF
}
@font-face {
	font-family: 'Roboto';
	font-style: normal;
	font-weight: 400;
	src: local(Roboto), local(Roboto-Regular), url(https://zrcdn.net/fonts/roboto/files/roboto_r_4.woff2) format('woff2');
	unicode-range: U+0370-03FF
}
@font-face {
	font-family: 'Roboto';
	font-style: normal;
	font-weight: 400;
	src: local(Roboto), local(Roboto-Regular), url(https://zrcdn.net/fonts/roboto/files/roboto_r_5.woff2) format('woff2');
	unicode-range: U+0102-0103, U+0110-0111, U+1EA0-1EF9, U+20AB
}
@font-face {
	font-family: 'Roboto';
	font-style: normal;
	font-weight: 400;
	src: local(Roboto), local(Roboto-Regular), url(https://zrcdn.net/fonts/roboto/files/roboto_r_6.woff2) format('woff2');
	unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+20A0-20AB, U+20AD-20CF, U+2C60-2C7F, U+A720-A7FF
}
@font-face {
	font-family: 'Roboto';
	font-style: normal;
	font-weight: 400;
	src: local(Roboto), local(Roboto-Regular), url(https://zrcdn.net/fonts/roboto/files/roboto_r_7.woff2) format('woff2');
	unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2212, U+2215
}
@font-face {
	font-family: 'Roboto';
	font-style: normal;
	font-weight: 500;
	src: local('Roboto Medium'), local(Roboto-Medium), url(https://zrcdn.net/fonts/roboto/files/roboto_m_1.woff2) format('woff2');
	unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F
}
@font-face {
	font-family: 'Roboto';
	font-style: normal;
	font-weight: 500;
	src: local('Roboto Medium'), local(Roboto-Medium), url(https://zrcdn.net/fonts/roboto/files/roboto_m_2.woff2) format('woff2');
	unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116
}
@font-face {
	font-family: 'Roboto';
	font-style: normal;
	font-weight: 500;
	src: local('Roboto Medium'), local(Roboto-Medium), url(https://zrcdn.net/fonts/roboto/files/roboto_m_3.woff2) format('woff2');
	unicode-range: U+1F00-1FFF
}
@font-face {
	font-family: 'Roboto';
	font-style: normal;
	font-weight: 500;
	src: local('Roboto Medium'), local(Roboto-Medium), url(https://zrcdn.net/fonts/roboto/files/roboto_m_4.woff2) format('woff2');
	unicode-range: U+0370-03FF
}
@font-face {
	font-family: 'Roboto';
	font-style: normal;
	font-weight: 500;
	src: local('Roboto Medium'), local(Roboto-Medium), url(https://zrcdn.net/fonts/roboto/files/roboto_m_5.woff2) format('woff2');
	unicode-range: U+0102-0103, U+0110-0111, U+1EA0-1EF9, U+20AB
}
@font-face {
	font-family: 'Roboto';
	font-style: normal;
	font-weight: 500;
	src: local('Roboto Medium'), local(Roboto-Medium), url(https://zrcdn.net/fonts/roboto/files/roboto_m_6.woff2) format('woff2');
	unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+20A0-20AB, U+20AD-20CF, U+2C60-2C7F, U+A720-A7FF
}
@font-face {
	font-family: 'Roboto';
	font-style: normal;
	font-weight: 500;
	src: local('Roboto Medium'), local(Roboto-Medium), url(https://zrcdn.net/fonts/roboto/files/roboto_m_7.woff2) format('woff2');
	unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2212, U+2215
}
body {
  font-family: Roboto, arial, sans-serif;
}
b {
	font-weight: 500;
}
a {
	color: #4687f1 !important;
	text-decoration: none;
	cursor: pointer;
}
a:hover {
	text-decoration: underline !important;
}
.bl_1 {
	background-color: #f0f7fd
}
.bl_2 {
	margin: 0 auto;
	max-width: 600px;
	padding: 12px 0;
}
.bl_3 {
	margin: 0 0 0 20px;
}
.bl_4 {
	width: 600px;
	max-width: 600px;
}
.bl_5 {
	color: #444444;
	font-size: 14px;
	font-weight: 400;
	line-height: 24px;
	margin: 0 auto;
	padding: 0;
	max-width: 600px;
}
.bl_6_main {
	margin: 40px 20px 25px 20px;
	font-size: 14px;
	font-weight: 400;
	color: #444444;
}
.bl_6_short {
	margin: 25px 20px;
	font-size: 14px;
	font-weight: 400;
	color: #444444;
}
.bl_6_li {
  margin: 5px 20px;
	font-size: 14px;
	font-weight: 400;
	color: #444444;
}
.bl_6_ending {
	margin-left: 20px;
	margin-right: 20px;
	margin-bottom: 35px;
	font-size: 14px;
	font-weight: 400;
	color: #444444;
}
.bl_app_cont {
	display: inline-block;
}
.bl_app_img {
	max-width: 120px;
	margin: 0 10px 30px 10px;
}
.bl_6 {
	margin: 50px 20px;
	font-size: 14px;
	font-weight: 400;
	color: #444444;
}
.bl_6_1 {
	margin: 25px 20px 50px 20px;
	font-size: 14px;
	font-weight: 400;
	color: #444444;
}
.bl_7 {
	border-top: 1px solid #efefef;
	padding-top: 35px;
	text-align: center;
	line-height: 14px;
	margin: 0 20px;
}
.bl_8 {
	color: #4687f1 !important;
	display: inline-block;
	margin: 0 20px;
	text-transform: uppercase;
	text-decoration: none;
	font-weight: 500;
	font-size: 14px;
}
.bl_9 {
	margin: 26px 12px 12px 12px;
	font-size: 13px;
	line-height: 16px;
	color: #444444;
}
.bl_10 {
	color: #777;
	margin: 12px 12px;
	font-size: 12px;
	line-height: 17px;
	margin-top: 0px;
	margin-bottom: 0px
}
.bl_12 {
	color: #777;
	margin: 12px 12px;
	font-size: 12px;
	line-height: 17px;
	margin-top: 0px;
	margin-bottom: 16px;
}
.bl_13 {
	margin: 0
}
.logo-img-paidwork {
	background-image: url('https://zrcdn.net/images/logos/paidwork/mail/pw-logo.png');
	background-repeat: no-repeat;
	width: 100%;
	height: 40px;
}
@media (max-width: 770px) {
	.logo-img-paidwork {
		background-image: url('https://zrcdn.net/images/logos/paidwork/mail/pw-logo-mobile.png');
		background-size: contain;
	}
	.bl_3 {
		margin: 0 0 0 22px
	}
	.bl_4 {
		width: 100%;
	}
}
";
