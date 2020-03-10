<div class="left-sidebar-pro">
    <nav id="sidebar" class="">
        <div class="sidebar-header">
            <a href="index.html"><img class="main-logo" src="img/logo/logo2.png" alt="" /></a>
            <strong><a href="index.html"><img src="img/logo/logosn1.png" alt="" /></a></strong>
        </div>
        <div class="left-custom-menu-adp-wrap comment-scrollbar">
            <nav class="sidebar-nav left-sidebar-menu-pro">
                <ul class="metismenu" id="menu1">
                  <?php
                  require_once '../controller/connection.php';
                  $db = new DbConnect();
                  $conn = $db->connect();
                  $stm = $conn->prepare("SELECT * FROM permiso p INNER JOIN ruta r ON p.id_ruta = r.id_ruta WHERE p.id_rol = ? AND r.nivel= 1 AND r.deleted_at IS NULL");
                  $stm->execute(array($_SESSION['id_rol']));
                  foreach ($stm as $result) {
                    $expand = ($result['ruta']) ? '' : 'has-arrow';
                    $ruta = ($result['ruta']) ? $result['ruta'] : '#';
                    ?>
                    <li>
                        <a title="<?php echo $result['nombre']; ?>" class="<?php echo $expand; ?>" href="<?php echo $ruta; ?>" aria-expanded="false"><span class="educate-icon <?php echo $result['icono']; ?> icon-wrap sub-icon-mg" aria-hidden="true"></span> <span class="mini-click-non"><?php echo $result['nombre']; ?></span></a>
                        <?php if (!$result['ruta']): ?>
                          <ul class="submenu-angle" aria-expanded="true">
                            <?php
                            $stm1 = $conn->prepare("SELECT*  FROM permiso p   INNER JOIN ruta r ON p.id_ruta = r.id_ruta WHERE p.id_rol = ? AND r.nivel= 2 AND id_parent = ? AND r.deleted_at IS NULL");
                            $stm1->execute(array($_SESSION['id_rol'], $result['id_ruta']));
                            foreach ($stm1 as $result1) {
                              ?>
                              <li><a title="<?php echo $result1['nombre']; ?>" href="<?php echo $result1['ruta']; ?>"><span class="mini-sub-pro"><?php echo $result1['nombre']; ?></span></a></li>
                              <?php
                            }
                            ?>
                          </ul>
                        <?php endif; ?>
                    </li>
                    <?php
                  };
                  ?>
                </ul>
            </nav>
        </div>
    </nav>
</div>
