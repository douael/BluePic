<header>
    <h1 id="titre">Connexion</h1>
</header>
<section id="content">
    <?php if (!empty($this->data) && array_key_exists("error", $this->data)) {
    $this->includeAlert("danger", $this->data['error']);
} ?>
    <?php if (!empty($this->data) && array_key_exists("verify", $this->data)) {
    $this->includeAlert("info", $this->data['verify']);
} ?>
    <?php if (!empty($this->data) && array_key_exists("tokenVerified", $this->data)) {
    $this->includeAlert("success", $this->data['tokenVerified']);
} ?>
    <?php if (!empty($this->data) && array_key_exists("wrongAccount", $this->data)) {
    $this->includeAlert("danger", $this->data['wrongAccount']);
} ?>
    <?php if (!empty($this->data) && array_key_exists("newPassword", $this->data)) {
    $this->includeAlert("info", $this->data['newPassword']);
} ?>

    <?php
    $this->includeModal("form", User::getLoginForm());
    ?>
</section>
