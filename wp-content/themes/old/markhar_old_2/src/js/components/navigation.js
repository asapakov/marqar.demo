const $ = jQuery; window.jQuery = $; window.$ = $;

const navInit = () => {
  const siteNavigation = document.getElementById('site-navigation');

  if (!siteNavigation) return;

  const button = siteNavigation.getElementsByTagName('button')[0];

  if (typeof button === 'undefined') return;

  const menu = siteNavigation.getElementsByTagName('ul')[0];

  // Скрыть кнопку переключения меню, если меню отсутствует.
  if (typeof menu === 'undefined') {
    button.style.display = 'none';
    return;
  }

  // Добавляем дополнительный класс для меню.
  if (!menu.classList.contains('nav-menu')) {
    menu.classList.add('nav-menu');
  }

  // Изменяем класс и aria-expanded для меню.
  button.addEventListener('click', () => {
    siteNavigation.classList.toggle('toggled');

    if (button.getAttribute('aria-expanded') === 'true') {
      button.setAttribute('aria-expanded', 'false');
    } else {
      button.setAttribute('aria-expanded', 'true');
    }
  });

  // Возвращаем состояние поумолчанию для меню, при клике на область документа.
  document.addEventListener('click', (event) => {
    const isClickInside = siteNavigation.contains(event.target);

    if (!isClickInside) {
      siteNavigation.classList.remove('toggled');
      button.setAttribute('aria-expanded', 'false');
    }
  });

  // Все ссылки меню.
  const links = menu.getElementsByTagName('a');

  // Все дочерние ссылки.
  const linksWithChildren = menu.querySelectorAll('.menu-item-has-children > a, .page_item_has_children > a');

  /**
   * Устанавливает или удаляет класс .focus для элемента.
   */
  const toggleFocus = (event) => {
    if (event.target.href.indexOf('/#') > -1) {
      event.preventDefault();
    }

    if (event.type === 'focus' || event.type === 'blur') {
      let self = event.target;

      // Проходимся по всем ссылкам
      while (!self.classList.contains('nav-menu')) {
        if (self.tagName.toLowerCase() === 'li') {
          self.classList.toggle('focus');
        }

        self = self.parentNode;
      }
    }

    if (event.type === 'click') {
      const menuItem = event.target.parentNode;

      menuItem.parentNode.children.forEach((link) => {
        link.classList.remove('focus');
      });

      menuItem.classList.toggle('focus');
    }
  };

  // Toggle focus each time a menu link is focused or blurred.
  links.forEach((link) => {
    link.addEventListener('focus', toggleFocus, true);
    link.addEventListener('blur', toggleFocus, true);
  });

  // Toggle focus each time a menu link with children receive a touch event.
  linksWithChildren.forEach((link) => {
    link.addEventListener('click', toggleFocus, false);
  });

  const $navToggles = document.querySelectorAll('.submenu-toggle');

  $navToggles.forEach(($navToggle) => {
    $navToggle.addEventListener('click', (evt) => {
      evt.preventDefault();

      const $ul = $navToggle.nextElementSibling;

      $navToggle.classList.toggle('submenu-toggle-open');
      $ul.classList.toggle('sub-menu-show');
    });
  });
};

export default navInit;
