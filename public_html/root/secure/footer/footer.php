<?php
if ($is_xampp) {

  if (count($create_path) == 4) {

    if (file_exists(stream_resolve_include_path($root_path."/root/secure/ajax/{$create_path[3]}/ajax-{$create_path[3]}.php"))) {
      include $root_path."/root/secure/ajax/{$create_path[3]}/ajax-{$create_path[3]}.php";
    }

  }

} else {

  if (count($create_path) == 2) {

    if (file_exists(stream_resolve_include_path($root_path."/root/secure/ajax/{$create_path[1]}/ajax-{$create_path[1]}.php"))) {
      include $root_path."/root/secure/ajax/{$create_path[1]}/ajax-{$create_path[1]}.php";
    }

  }

}
?>

</div>
</div>

</body>
</html>
