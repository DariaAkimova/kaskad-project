<footer class="footer">
<div class="container">
    <section class="footer__contacts footer-contacts">
      <h2 class="footer-contacts__title">Контакты:</h2>
      <div class="footer-contacts__info">
        <p class="footer-contacts__phone">8-901-310-26-32</p>
        <p class="footer-contacts__mail">aec-kaskad@yandex.ru</p>
        <p class="footer-contacts__adress">г. Санкт-Петербург, ул. Ватутина, д. 18, оф.1
        </p>
      </div>
    </section>
    <form action="form.php" method="post" class="footer__form form">
      <fieldset class="form__user-info user-info form-fieldset">
        <label class="user-info__field form-field"><span class="form__label form-label"> Название фирмы или
            контактное
            лицо:*</span>
          <input class="user-info__input input input--name" type="text" name="user-name" required>
        </label>
      </fieldset>
      <fieldset class="form__contacts contacts-form form-fieldset">
        <label class="contacts-form__field form-field"><span class="form__label form-label">
            Телефон:*</span>
          <input class="contacts-form__input input input--phone" type="tel" name="phone" placeholder="8 (000) 000-00-00" required>
        </label>
        <label class="contacts-form__field form-field"><span class="form__label form-label">
            e-mail:*</span>
          <input class="contacts-form__input input input--email" type="email" name="email" placeholder="mail@mail.com" required>
        </label>
      </fieldset>
      <fieldset class="form__comments comments form-fieldset">
        <label class="comments__field form-field"><span class="form__label form-label">
            Ваше сообщение</span>
          <textarea class="comments__input" name="comments">
      </textarea>
        </label>
        <!-- Скрытое поле - защита от спама -->
        <textarea class="hidden" name="other-comment">
        </textarea>
      </fieldset>
      <fieldset class="form__personal-agree personal-agree form-fieldset">
        <label class="personal-agree__field">
          <input type="checkbox" name="personal-agree" class="personal-agree__checkbox" required>
          <span class="personal-agree__label">Я согласен на обработку персональных данных в
            соответствии с <a href="privacy-policy.php" class="personal-agree__link" target="_blank">политикой
              конфиденциальности</a> </span>

        </label>
      </fieldset>
      <div class="form__validation-message validation-error hidden">
        <p class="validation-error__message">Пожалуйста, заполните все обязательные поля и повторите отправку заявки
        </p>
      </div>
      <div class="form__footer">
        <div class="form__buttons buttons-wrapper">
          <button class="form__submit button" type="submit">Отправить</button>
          <button class="form__reset button button--secondary" type="reset">Сбросить значения</button>
        </div>
        <p class="form__legend">Oбязательные поля помечены *</p>
      </div>
    </form>
    <div class="footer__other-info">
      Санкт-Петербург, 2022г.
    </div>
  </div>
</footer>