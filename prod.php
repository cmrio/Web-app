<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Продукты в БД</title>
  <link rel="stylesheet" href="mainP.css">
  </head>

<body>
  <br>
  <nav>
    <ul class="topmenu">
      
            <li><a href="" class="active">Поиск<span class="fa fa-angle-down"></span></a>
        <ul class="submenu">
          <li><a href="">Продуктов<span class="fa fa-angle-down"></span></a>
            <ul class="submenu">
              <li><a href="/WEB-APP/script/poisk/search_prod_sk.php">На складе<span class="fa fa-angle-down"></span></a>
              </li>
              <li><a href="/WEB-APP/script/poisk/search_prod_usd.php">Использованых<span class="fa fa-angle-down"></span></a>
              </li>
              <li><a href="/WEB-APP/script/poisk/search_prod_dis.php">Списанных<span class="fa fa-angle-down"></span></a>
              </li>
            </ul>
          </li>

          <li><a href="/WEB-APP/script/poisk/search_prov.php">Поставщиков<span class="fa fa-angle-down"></span></a>
          </li>

          <li><a href="/WEB-APP/script/poisk/cont_date.php">Договоров по датам<span class="fa fa-angle-down"></span></a>
          </li>

          <li><a href="/WEB-APP/script/poisk/search_ord.php">Заказов<span class="fa fa-angle-down"></span></a>
          </li>

        </ul>
      </li>

      <li><a href="" class="active">Продукты<span class="fa fa-angle-down"></span></a>
        <ul class="submenu">
          <li><a href="/WEB-APP/script/sklad/sklad.php">Продукты на складе</a></li>
          <li><a href="/WEB-APP/script/product/used.php">Использованые продукты</a></li>
          <li><a href="/WEB-APP/script/product/dis.php">Списанные продукты</a></li>
          <li><a href="/WEB-APP/script/product/prod.php">Продукты в БД</a></li>
        </ul>
      </li>

      <li><a href="" class="active">Договора<span class="fa fa-angle-down"></span></a>
        <ul class="submenu">
          <li><a href="/WEB-APP/script/dogovor/dogovora_act.php">Активные</a></li>
          <li><a href="/WEB-APP/script/dogovor/dogovora_pass.php">Не активные</a></li>
          <li><a href="/WEB-APP/script/dogovor/add_dogovor.php">Добавить договор</a></li>
          <li><a href="">Изменить договор<span class="fa fa-angle-down"></span></a>
            <ul class="submenu">
              <li><a href="/WEB-APP/script/dogovor/change_info.php">Изменить данные о договоре</a></li>
              <li><a href="/WEB-APP/script/dogovor/change_date.php">Изменить даты договора</a></li>
            </ul>
          </li>
        </ul>
      </li>

      <li><a href="" class="active">Заказы<span class="fa fa-angle-down"></span></a>
        <ul class="submenu">
          <li><a href="/WEB-APP/script/zakaz/postavki_act.php">Актуальные</a></li>
          <li><a href="/WEB-APP/script/zakaz/postavki_pass.php">Не актуальные</a></li>
          <li><a href="/WEB-APP/script/zakaz/add_zakaz.php">Добавить заказ</a></li>
          <li><a href="/WEB-APP/script/zakaz/change_zakaz.php">Изменить заказ</a></li>
        </ul>
      </li>

      <li><a href="/WEB-APP/script/provider/prov.php">Поставщики</a></li>


    </ul>
  </nav>



  <table width="100%" cellspacing="0" cellpadding="5">
    <tr>
      <td align="left">
        <a href="/WEB-APP/script/product/add_prod.php" class="button8">Добавить продукт</a>
        <br>
        <br>
        <a href="/WEB-APP/script/product/change_prod.php" class="button8">Изменить продукт</a>
      </td>
      <td align="middle">
        <?php
       $i = 0;
       $host = 'localhost';
       $db   = 'curs';
       $user = 'vitaliy';
       $pass = '1234';
       $charset = 'utf8';
       $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
       $pdo = new PDO($dsn, $user, $pass,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

       $stmt = $pdo->query ('SELECT name_product, meas_product, strg_product 
                             FROM product
                             ORDER BY name_product ASC ');

        while ($row = $stmt->fetch()) {
        $prod[$i][0] = $row['name_product']; 
        $prod[$i][1] = $row['meas_product']; 
        if( $row['strg_product']%10 == 1 and $row['strg_product']!=11 ) {
          $prod[$i][2] = $row['strg_product'].' день'; } else {
        if( $row['strg_product'] == 12 or $row['strg_product'] == 13 or $row['strg_product'] == 14 ) {
          $prod[$i][2] = $row['strg_product'].' дней'; } else {
        if( $row['strg_product']%10 == 2 or $row['strg_product']%10 == 3 or $row['strg_product']%10 == 4 ) {
          $prod[$i][2] = $row['strg_product'].' дня';} else {
          $prod[$i][2] = $row['strg_product'].' дней'; } } }
        $i = $i + 1;       
                                   } 
              
      if($i != 0) {

       echo '<table class="scroll" align="center" border="1">
            <thead>
              <tr>
                <th>Название продукта</th>
                <th>Единицы измерения</th>
                <th>Максимальный срок хранения</th>
              </tr>
              <thead>
                <tbody>';
                  
            for($i = 0; $i < count($prod); $i++){
             echo '<tr>';
             echo '<td align="center"><font color="#454545" size ="3"><b>'.$prod[$i][0].'</b></font></td>'.'<td align="center">'.$prod[$i][1].'</td>'.'<td align="center">'.$prod[$i][2].'</td>'; 
             echo '</tr>'; }
           

       echo '</tbody>
          </table>'; } else {
                  echo '<font color="#454545" size ="6"><b>Нечего не найдено</b></font>';} ?>
      </td>
           <td align="left" width="20%" valign="top">
        <br>
        <br>
        <br>
        <br>
        <form action="/WEB-APP/script/product/after_search_prod.php" METHOD="post">
          <b>Введите название продукта</b><p>
          <INPUT TYPE="text" name = "name" required required size="30">
        <INPUT TYPE="Submit" VALUE= "Поиск" > <br>
        </form>
        <br>
        <br>
        
        
  <table class="new" align="right" border="1" >
          <thead>
            <tr>
              <th><b>Доска обьявлений</b></th>
            </tr>
          </thead>
          <tbody>
            <?php
             $i = 1;
            $stmt = $pdo->query ('SELECT Prod, Str,Zakaz 
                                  FROM sklad
                                  where Str < 4 ');
                 while ($row = $stmt->fetch()) {
                 echo '<tr>';
                 if($row['Str'] > 0) {
                 if( $row['Str']%10 == 1 and $row['Str']!= 11 ) {
                   echo '<td>'.$i.'.<em> У продукта со склада '.$row['Prod'].',номер заказа '.$row['Zakaz'].',через '.$row['Str'].' день закончится срок хранение</em>'.'</td>'; $i++;} else {
                 if( $row['Str'] == 12 or $row['Str'] == 13 or $row['Str'] == 14 ) {
                   echo '<td>'.$i.'.<em> У продукта со склада '.$row['Prod'].',номер заказа '.$row['Zakaz'].',через '.$row['Str'].' дней закончится срок хранение</em>'.'</td>'; $i++;} else { 
                 if( $row['Str']%10 == 2 or $row['Str']%10 == 3 or $row['Str']%10 == 4 ) {
                   echo '<td>'.$i.'.<em> У продукта со склада '.$row['Prod'].',номер заказа '.$row['Zakaz'].',через '.$row['Str'].' дня закончится срок хранение</em>'.'</td>'; $i++; } else {
                   echo '<td>'.$i.'.<em> У продукта со склада '.$row['Prod'].',номер заказа '.$row['Zakaz'].',через '.$row['Str'].' дней закончится срок хранение</em>'.'</td>';$i++;} } }
                                   }
                                              }

            $stmt = $pdo->query ('SELECT name_prov, DATEDIFF(dateend,CURRENT_DATE), flag
                                  FROM provider INNER JOIN (product INNER JOIN contract ON product.id_product = contract.prod) ON provider.id_prov = contract.prov
                                  WHERE (flag = 1) AND (DATEDIFF(dateend,CURRENT_DATE) < 30)');
                 while ($row = $stmt->fetch()) {
                 if($row['DATEDIFF(dateend,CURRENT_DATE)']>0) {
                 echo '<tr>';
                 if( $row['DATEDIFF(dateend,CURRENT_DATE)']%10 == 1 and $row['DATEDIFF(dateend,CURRENT_DATE)'] != 11 ) {   
                  echo '<td>'.$i.'.<em> Договор с фирмой '.$row['name_prov'].' истекает через '.$row['DATEDIFF(dateend,CURRENT_DATE)'].' день</em>'.'</td>'; $i++;} else {
                 if( ($row['DATEDIFF(dateend,CURRENT_DATE)'] == 12) or ($row['DATEDIFF(dateend,CURRENT_DATE)'] == 13) or ($row['DATEDIFF(dateend,CURRENT_DATE)'] == 14) ) {   
                  echo '<td>'.$i.'.<em> Договор с фирмой '.$row['name_prov'].' истекает через '.$row['DATEDIFF(dateend,CURRENT_DATE)'].' дней</em>'.'</td>'; $i++;} else {
                 if( ($row['DATEDIFF(dateend,CURRENT_DATE)']%10 == 2) or ($row['DATEDIFF(dateend,CURRENT_DATE)']%10 == 3) or ($row['DATEDIFF(dateend,CURRENT_DATE)']%10 == 4) ) {   
                  echo '<td>'.$i.'.<em> Договор с фирмой '.$row['name_prov'].' истекает через '.$row['DATEDIFF(dateend,CURRENT_DATE)'].' дня</em>'.'</td>'; $i++; } else {
                  echo '<td>'.$i.'.<em> Договор с фирмой '.$row['name_prov'].' истекает через '.$row['DATEDIFF(dateend,CURRENT_DATE)'].' дней</em>'.'</td>';$i++; } } }              
                 echo '</tr>';    
                                                               }
                                                }

            $stmt = $pdo->query ('SELECT Prod,Kol,m
                                  FROM (
                                    SELECT name_product AS Prod, SUM(curr_count) AS Kol,meas_product AS m
                                    FROM product INNER JOIN ((contract INNER JOIN ORD ON contract.id_con = ord.id_cont) INNER JOIN currently ON ord.id_ord = currently.id_ord_curr) ON product.id_product = contract.prod
                                    GROUP BY name_product) AS A
                                    WHERE ( ((A.Kol < 20) AND (A.m="кг")) OR ((A.Kol < 40) AND (A.m="л")) )');
                 while ($row = $stmt->fetch()) {
                 echo '<tr>';
                 echo '<td>'.$i.'.<em> Товар '.$row['Prod'].' заканчивается на складе. Осталось: '.$row['Kol'].' '.$row['m'].'</em></td>';
                 echo '</tr>';  $i++;  
                                   }

           ?>
          </tbody>
        </table>
      </td>
    </tr>
  </table>



</body>

</html>