<!DOCTYPE html>
<html lang="ru">


<?php
$page_name = "Каскад";
$page_description = "Продажа электронных компонентов импортного и отечественного производства: 
  интегральные микросхемы, транзисторы, лазерные головки для CD и DVD, магнетроны, трансформаторы, блоки питания, паяльное оборудование, 
  пульты дистанционного управления, провода, кабели, разъемы, светодиодные ленты и энергосберегающие 
  лампы на основе LED технологии; монтаж светодиодных лент; разработка и проектирование световых эффектов на основе мощных светодиодов и разноцветных лент ";

  require('components/head.php');
?>

<body>

  <?php
  require('components/header.php');
  ?>

  <main class="main-container no-js">
    <div class="main-wrapper">
      <h1 class="visually-hidden">Каскад</h1>
      <div class="container main-wrapper">

        <section class="main-wrapper__section promo">
          <h2 class="promo__title section-title">Продажа электронных компонентов импортного и отечественного
            производства
          </h2>
          <a class="promo__button download-btn" href="#price-list"><span class="download-btn__text">Скачать
              прайс-листы</span></a>
        </section>

        <div class="main-block">
          <section class="main-container__section about-us" id="about-us-section">
            <h2 class="about-us__title section-title">О компании</h2>
            <p class="about-us__text">Санкт-Петербургская компания "Каскад" предлагает:</p>
            <ul class="about-us__list">
              <li class="about-us__item about-us__item--goods">
                <ul class="about-us__description about-us__goods-list goods-list">
                  <li class="goods-list__item"> интегральные микросхемы,</li>
                  <li class="goods-list__item"> транзисторы,</li>
                  <li class="goods-list__item"> лазерные головки для CD и DVD,</li>
                  <li class="goods-list__item"> магнетроны,</li>
                  <li class="goods-list__item"> трансформаторы,</li>
                  <li class="goods-list__item"> блоки питания,</li>
                  <li class="goods-list__item"> паяльное оборудование,</li>
                  <li class="goods-list__item"> пульты дистанционного управления,</li>
                  <li class="goods-list__item"> провода, кабели, разъемы,</li>
                  <li class="goods-list__item"> светодиодные ленты и энергосберегающие лампы на основе LED технологии.
                  </li>
                </ul>
              </li>
              <li class="about-us__item about-us__item--complex">
                <p class="about-us__description"> Подбор и организацию комплексных поставок.
                </p>
              </li>
              <li class="about-us__item about-us__item--installation">
                <p class="about-us__description">Монтаж светодиодных лент.
                </p>
              </li>
              <li class="about-us__item about-us__item--led">
                <p class="about-us__description">Разработку и проектирование световых эффектов для вашего дома и офиса
                  на
                  основе мощных светодиодов и разноцветных лент.</p>
              </li>
              <li class="about-us__item about-us__item--delivery">
                <p class="about-us__description">Доставку заказов в регионы по почте и транспортными компаниями.
                </p>
              </li>
            </ul>
          </section>
          <section class="main-container__section price-list" id="price-list">
            <h2 class="section-title">Скачать прайс-листы</h2>
            <ul class="price-list__list">
              <li class="price-list__item"><a href="xls/poluprovodniki-price.xls" class="price-list__download-link" target="_blank">Полупроводники</a> </li>
              <li class="price-list__item"><a href="xls/svetodiodnaya-technika-price.xls" class="price-list__download-link" target="_blank">Светодиодная техника</a></li>
            </ul>
          </section>
        </div>
        <aside class="aside no-js">
          <h2 class="aside__title hidden">специальное предложение</h2>
          <ul class="aside__promo promo-list list">
            <?php
            require('mysql-connection.php');

            $sql = "SELECT * FROM offer_cards";
            $result = mysqli_query($mysql, $sql);
            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
            foreach ($rows as $row) {
            ?>
              <li class="promo-list__item">
                <div class="sale-card">
                  <div class="sale-card__label">
                    <?= $row['cathegory']; ?>
                  </div>
                  <h3 class="sale-card__title">
                    <?= $row['title']; ?>
                  </h3>
                  <div class="sale-card__img-wrapper">
                    <picture>
                      <source media="(min-width:1340px)" srcset="<?= $row['img_desktop@1x']; ?> 1x, <?= $row['img_desktop@2x']; ?> 2x">
                      <img class="sale-card__image " src="<?= $row['img_mobile@1x']; ?>" srcset="<?= $row['img_mobile@2x']; ?> 2x" width="135" height="100" alt="<?= $row['cathegory']; ?> : <?= $row['title']; ?>">
                    </picture>
                  </div>
                  <div class="sale-card__info product-info">
                    <dl class="product-info__description">
                      <dt class="product-info__parameter">Цена:</dt>
                      <dd class="product-info__value product-info__value--important">
                        <?= $row['price']; ?>p.
                      </dd>

                    </dl>
                  </div>
                </div>
              </li>
            <?php
            }
            ?>

          </ul>
        </aside>
      </div>
    </div>
  </main>

  <button class="button-up hidden" type="button" aria-label="Наверх"></button>

  <?php
  require('components/footer.php');
  ?>

  <!-- Сообщение об успешном создании заявки -->
  <template id="success">
    <div class="success">
      <p class="success__message">Ваше сообщение отправлено!</p>
    </div>
  </template>

  <!-- Сообщение об ошибке создания заявки -->
  <template id="error">
    <div class="error">
      <div class="error__wrapper">
        <p class="error__message">Ошибка! Ваше сообщение не отправлено, попробуйте снова.</p>
        <button type="button" class="error__button button">Попробовать снова</button>
      </div>
    </div>
  </template>


  <script type="module" src="js/script.bundle.js"></script>
</body>

</html>