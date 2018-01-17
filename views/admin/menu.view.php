<header>
    <h1 id="titre">Menu</h1>
</header>
<section id="content">
	<?php
      $uri = $_SERVER['REQUEST_URI'];
      $this->uri = trim($uri, "/");
      $this->uriExploded = explode("/", $this->uri);
      $link = $this->uriExploded;

      if (!array_key_exists(2, $link)) {
          $this->includeModal("form", Menu::getMenuForm($allMenuElement));
      } else {
          if ($link[2]!="show") {
              $this->includeModal("form", Menu::getMenuForm($allMenuElement));
          } else {
              $this->includeModal("form", Menu::getMenuEditForm($thisMenu, $allMenuElement));
              $this->includeModal("form", Menu::getMenuArchivedForm($thisMenu));
          }
      }
      ?>
</section>

<script>
    $(document).ready(function() {
        $('#btn-up').bind('click', function() {
            $('#elements option:selected').each( function() {
                var newPos = $('#elements option').index(this) - 1;
                if (newPos > -1) {
                    $('#elements option').eq(newPos).before("<option value='"+$(this).val()+"' selected='selected'>"+$(this).text()+"</option>");
                    $(this).remove();
                }
            });
        });
        $('#btn-down').bind('click', function() {
            var countOptions = $('#elements option').length;
            $('#elements option:selected').each( function() {
                var newPos = $('#elements option').index(this) + 1;
                if (newPos < countOptions) {
                    $('#elements option').eq(newPos).after("<option value='"+$(this).val()+"' selected='selected'>"+$(this).text()+"</option>");
                    $(this).remove();
                }
            });
        });
    });
</script>
