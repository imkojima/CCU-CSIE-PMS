# CCU CSIE Property Management System

# Installation

測試於 Ubuntu 12.04.1 LTS (GNU/Linux 3.2.0-23-generic x86_64)
及 MySQL 5.5.24 與 Apache 2.2.22 (運行php 5.3.10)

1. 建立SQL資料庫並準備帳號連線資料，確保使用的賬號對該資料有足夠的權限

2. 在 libs/db_object.php 中填入MySQL伺服器位置、帳號、密碼、資料庫名稱

3. 將 CCUPMS.sql 匯入該資料庫

4. 將整個系統資料夾放置至目標位置，該位置應能以網頁伺服器存取

5. 至此應可透過瀏覽器操作此系統

# Notice

目前使用者的部分請先直接操作資料庫將特定人先設為管理者，之後可以該帳號提升其他使用者的權限。

目前尚有需多需要改善的部分及補足的功能，請等待下一次(2013/2)的更新。
力求在101學年度下學期將此系統上線。

-
This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program.  
If not, see <http://www.gnu.org/licenses/>.

Copyright
-
(C)2012 CCU CSIE http://www.cs.ccu.edu.tw
