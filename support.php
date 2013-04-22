<?php
/*
    This file is part of CCU CSIE Property Management System.

    CCU CSIE Property Management System is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    CCU CSIE Property Management System is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with CCU CSIE Property Management System.  If not, see <http://www.gnu.org/licenses/>.
*/
?>
<!DOCTYPE html>
<html lang="zh-tw">
  <head>
    <meta charset="utf-8">
    <title>說明 | CCU CSIE Property</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css">
    <link rel="stylesheet" type="text/css" href="css/nomoretable.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
	<style>
	.question {
		cursor:pointer;
	}
	</style>  
  </head>

  <body>

<?php include_once('blocks/navbar.php'); ?>

    <div class="container" >

      <section id="query-list">
        <ul class="breadcrumb">
          <li><a href="index.php">首頁</a> <span class="divider">/</span></li>
          <li class="active">說明</li>
        </ul>

        <div class="tabbable">
          <div class="row">
            <div class="span8 offset2">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#login" data-toggle="tab">登入</a></li>
                <li><a href="#request" data-toggle="tab">借用</a></li>
                <li><a href="#account" data-toggle="tab">帳號</a></li>
				<li><a href="#other" data-toggle="tab">其他</a></li>
              </ul>
            </div>
          </div>

          <div class="tab-content">
            <div class="tab-pane active" id="login">
      	      <div class="row">
                <div class="span8 offset2">
                  <div class="thumbnail" style="margin-bottom:10px;">
                    <div class="question">
                      <h4><span class="badge badge-info"><i style="vertical-align:baseline;" class="icon-question-sign"></i></span> 如何登入這個系統？</h4>
                    </div>
                    <div class="answer">  
                      <hr />      
                      <p>本系統使用校園系統單一入口作為帳號簽入的認證，<b>請直接使用學籍系統的帳號、密碼登入使用。</b><br/>校園系統單一入口： <a href="http://portal.ccu.edu.tw/">http://portal.ccu.edu.tw/</a></p></div>
                    </div>
                  <div class="thumbnail" style="margin-bottom:10px;">
                    <div class="question">
                      <h4><span class="badge badge-info"><i style="vertical-align:baseline;" class="icon-question-sign"></i></span> 無法登入怎麼辦？</h4>
                    </div>          
                    <div class="answer"> 
                      <hr />
                      <p>請檢查您所輸入的帳號密碼與學籍系統上登錄的相符，建議可嘗試登入單一入口或選課系統看看是否有一樣的情況。<br/>若有相同情形，請至教務處查詢。</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
             <div class="tab-pane" id="request">
              <div class="row">
                <div class="span8 offset2">
                  <div class="thumbnail" style="margin-bottom:10px;">
                    <div class="question">
                      <h4><span class="badge badge-info"><i style="vertical-align:baseline;" class="icon-question-sign"></i></span> 如何借用？</h4>
                    </div>          
                    <div class="answer"> 
                      <hr />
					  <p>請於 <blockquote><i style="vertical-align:baseline;" class="icon-book"></i> 借用</blockquote> 瀏覽財產資料庫，選擇您所需的項目。<br/>
						 需要填寫預約有效的範圍及借用原因備查，待承辦人員審核通過即發信通知您前來取用。</p>
                    </div>
                  </div>
                  <div class="thumbnail" style="margin-bottom:10px;">
                    <div class="question">
                      <h4><span class="badge badge-info"><i style="vertical-align:baseline;" class="icon-question-sign"></i></span> 無法借用？</h4>
                    </div>          
                    <div class="answer"> 
                      <hr />
                      <p>可能沒有填寫基本資料</p>
                    </div>
                  </div>
                   <div class="thumbnail" style="margin-bottom:10px;">
                    <div class="question">
                      <h4><span class="badge badge-info"><i style="vertical-align:baseline;" class="icon-question-sign"></i></span> 借用的機制是如何進行的？</h4>
                    </div>          
                    <div class="answer"> 
                      <hr />
                      <p>你可能要等 iPhone5S 出來後才排得到了</p>
                    </div>
                  </div> 
                   <div class="thumbnail" style="margin-bottom:10px;">
                    <div class="question">
                      <h4><span class="badge badge-info"><i style="vertical-align:baseline;" class="icon-question-sign"></i></span> 預約天數是什麼？</h4>
                    </div>          
                    <div class="answer"> 
                      <hr />
                      <p>你可能要等 iPhone5S 出來後才排得到了</p>
                    </div>
                  </div> 
                </div>
              </div>
            </div>

             <div class="tab-pane" id="account">
              <div class="row">
                <div class="span8 offset2">
                   <div class="thumbnail" style="margin-bottom:10px;">
                    <div class="question">
                      <h4><span class="badge badge-info"><i style="vertical-align:baseline;" class="icon-question-sign"></i></span> 為什麼需要填寫基本資料？</h4>
                    </div>          
                    <div class="answer"> 
                      <hr />
                      <p>你可能要等 iPhone5S 出來後才排得到了</p>
                    </div>
                  </div> 
                  <div class="thumbnail" style="margin-bottom:10px;">
                    <div class="question">
                      <h4><span class="badge badge-info"><i style="vertical-align:baseline;" class="icon-question-sign"></i></span> 要如何修改個人資料？</h4>
                    </div>          
                    <div class="answer"> 
                      <hr />
                      <p>首頁 -> 帳號，或是右上角帳號選單裡面選擇 個人資料，在頁面左下角有編輯資料按鈕。</p>
                    </div>
                  </div>
                  <div class="thumbnail" style="margin-bottom:10px;">
                    <div class="question">
                      <h4><span class="badge badge-info"><i style="vertical-align:baseline;" class="icon-question-sign"></i></span> 我想看 iPhone5 官方新聞稿</h4>
                    </div>          
                    <div class="answer"> 
                      <hr />
                      <p>Apple® 今天宣佈 iPhone® 5 將於 12 月 7 日星期五在韓國上市。12 月，iPhone 5 還將在其他 50 多個國家和地區上市，包括巴西、俄羅斯及台灣。iPhone 5 是歷來最纖薄、最輕巧的 iPhone，經過完全重新設計，配備纖麗奪目的全新 4 吋 Retina 顯示器，Apple 設計的全新 A6 晶片，效能強大卻不耗電，以及支援最新的無線技術*，一應俱全卻仍提供更佳的電池續航力**。</p>
                    </div>
                  </div>
                  <div class="thumbnail" style="margin-bottom:10px;">
                    <div class="question">
                      <h4><span class="badge badge-info"><i style="vertical-align:baseline;" class="icon-question-sign"></i></span> 我不小心進到別人帳號裡了，可以做什麼嗎？</h4>
                    </div>          
                    <div class="answer"> 
                      <hr />
                      <p>基本上我們建議您立刻登出，避免影響他人權益，但如果是 499410031 ，請儘管亂用。</p>
                    </div>
                  </div>
                  <div class="thumbnail" style="margin-bottom:10px;">
                    <div class="question">
                      <h4><span class="badge badge-info"><i style="vertical-align:baseline;" class="icon-question-sign"></i></span> 聽說獅子成績很好，找不到對手</h4>
                    </div>          
                    <div class="answer"> 
                      <hr />
                      <p>暫時無解，他只要有啤酒配棒球就能考滿分</p>
                    </div>
                  </div>  
                </div>
              </div>
            </div>
 
            <div class="tab-pane" id="other">
              <div class="row">
                <div class="span8 offset2">
                  <div class="thumbnail" style="margin-bottom:10px;">
                    <div class="question">
                      <h4><span class="badge badge-info"><i style="vertical-align:baseline;" class="icon-question-sign"></i></span> 誰做了這個系統？</h4>
                    </div>          
                    <div class="answer"> 
                      <hr />
                      <p>很難解釋，但可以給你看開發過程中的照片(如下圖)。</p>
					  <img src="img/makers.jpg"/> 
                    </div>
                  </div> 
                  <div class="thumbnail" style="margin-bottom:10px;">
                    <div class="question">
                      <h4><span class="badge badge-info"><i style="vertical-align:baseline;" class="icon-question-sign"></i></span> 系統維護及更新資訊</h4>
                    </div>          
                    <div class="answer"> 
                      <hr />
					  <img src="img/ccu.gif"/> 
					  <p>國立中正大學資訊工程學系 2012</p>
                    </div>
                  </div> 
                </div>
              </div>
            </div>

          </div>
        </div>        
      </section>

      <div class="footer">
        <hr />
        <p>Property Management System - &#169;2012 Dept. of CSIE, National Chung Cheng University</p>
      </div> 
    </div>

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $('.answer').hide();
        $('.question').toggle(
          function () {
            $(this).next('.answer').fadeIn();
          },
          function () {
            $(this).next('.answer').fadeOut();
          }
        );
      });
    </script>
  </body>
</html>
