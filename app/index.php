<?php
    require_once( 'inc/settings.php' );
    require_once( 'inc/functions.php' );
?>

<!DOCTYPE html>

<html lang = "en">

    <head>

        <meta charset = "utf-8" />
        <meta name = "viewport" content = "width=device-width, initial-scale=1, user-scalable=1, minimal-ui" />
        <meta http-equiv = "X-UA-Compatible" content = "IE=edge,chrome=1" />
        <link rel = "shortcut icon" type = "image/ico" href = "http://www.nevma.gr/favicon.ico" />
        <title>WordPress staging website creation</title>



        <!-- Responsiville CSS declarations -->

        <link rel = "stylesheet" type = "text/css" href = "assets/responsiville/css/responsiville.def.css" />
        <link rel = "stylesheet" type = "text/css" href = "assets/responsiville/css/responsiville.bugsy.css" />
        <link rel = "stylesheet" type = "text/css" href = "assets/responsiville/css/responsiville.moressette.css" />
        <link rel = "stylesheet" type = "text/css" href = "assets/responsiville/css/responsiville.ingrid.css" />
        <link rel = "stylesheet" type = "text/css" href = "assets/responsiville/css/responsiville.accordion.css" />
        <link rel = "stylesheet" type = "text/css" href = "assets/responsiville/css/responsiville.megamenu.css" />
        <link rel = "stylesheet" type = "text/css" href = "assets/responsiville/css/responsiville.mobimenu.css" />
        <link rel = "stylesheet" type = "text/css" href = "assets/responsiville/css/responsiville.scrollmenu.css" />
        <link rel = "stylesheet" type = "text/css" href = "assets/responsiville/css/responsiville.slideshow.css" />

        <!-- Third party CSS decarlations -->

        <link rel = "stylesheet" href = "https://fonts.googleapis.com/css?family=Averia+Serif+Libre:300,300i">
        <link rel = "stylesheet" href = "https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i">
        <link rel = "stylesheet" href = "https://fonts.googleapis.com/css?family=Anonymous+Pro:400,400i">

        <!-- Current page styles -->

        <link rel = "stylesheet" type = "text/css" href = "assets/css/style.css" />



        <!-- Third party Javascript libraries -->

        <script type = "text/javascript" charset = "utf-8" src = "assets/js/jquery-3.1.0.min.js"></script>
        <script type = "text/javascript" charset = "utf-8" src = "assets/js/velocity.min.js"></script>

        <!-- Responsiville Javascript files -->

        <script type = "text/javascript">

            RESPONSIVILLE_AUTO_INIT = true;
            RESPONSIVILLE_DEBUG     = false;

        </script>

        <script type = "text/javascript" charset = "utf-8" src = "assets/responsiville/js/responsiville.def.js"></script>
        <script type = "text/javascript" charset = "utf-8" src = "assets/responsiville/js/responsiville.bugsy.js"></script>
        <script type = "text/javascript" charset = "utf-8" src = "assets/responsiville/js/responsiville.events.js"></script>
        <script type = "text/javascript" charset = "utf-8" src = "assets/responsiville/js/responsiville.main.js"></script>
        <script type = "text/javascript" charset = "utf-8" src = "assets/responsiville/js/responsiville.main.run.js"></script>
        <script type = "text/javascript" charset = "utf-8" src = "assets/responsiville/js/responsiville.accordion.js"></script>
        <script type = "text/javascript" charset = "utf-8" src = "assets/responsiville/js/responsiville.equalheights.js"></script>
        <script type = "text/javascript" charset = "utf-8" src = "assets/responsiville/js/responsiville.megamenu.js"></script>
        <script type = "text/javascript" charset = "utf-8" src = "assets/responsiville/js/responsiville.mobimenu.js"></script>
        <script type = "text/javascript" charset = "utf-8" src = "assets/responsiville/js/responsiville.scrollmenu.js"></script>
        <script type = "text/javascript" charset = "utf-8" src = "assets/responsiville/js/responsiville.slideshow.js"></script>
        <script type = "text/javascript" charset = "utf-8" src = "assets/responsiville/js/responsiville.run.js"></script>

        <!-- Entry script for tests -->

        <script type = "text/javascript" charset = "utf-8" src = "assets/js/functions.js"></script>

    </head>

    <body>

        <main class = "wrapper small-column-60 small-center">

                <header>
                    <h1>WordPress staging website creation</h1>
                    <p>
                        <?php $url = get_base_url(); ?>
                        <a href = "<?php echo $url; ?>" title = "Home">Home</a> &bull;
                        <a href = "<?php echo $url; ?>" title = "Refresh">Refresh</a> &bull;
                        <a href = "?action=help" title = "Home">Help</a> &bull;
                        <?php
                            $log_length = intval( isset( $_GET['log-length'] ) ? $_GET['log-length'] : '0' );
                            if ( $log_length <= 0 ) {
                                $log_length = 100;
                            }
                        ?>
                        Show last <input class = "inline text-center" type = "text" name = "log-length" ID = "log-length" value = "<?php echo $log_length ?>" placeholder = "100" size = "3" /> log lines:
                        <a href = "?action=log" class = "button button-small action-log" title = "View log">Go</a>
                    </p>
                </header>

                <?php ensure_directories(); ?>

                <?php check_settings(); ?>

                <?php handle_actions(); ?>

                <section class = "content">
                    <h2>Create new staging website</h2>
                    <form action = "?action=create" method = "post" class = "row">
                        <div class = "small-column-30">
                            <label for = "name">Staging name [a-zA-Z0-9]</label>
                            <input type = "text" name = "name" id = "name" placeholder = "name" />
                        </div>
                        <div class = "small-column-50">
                            <label for = "path">Original website path (just start typing)</label>
                            <input list = "websites-list" name = "path" id = "path" placeholder = "/home/user/public_html/" />
                            <datalist id = "websites-list">
                                <?php foreach ( get_wordpress_websites() as $website ) : ?>
                                    <option value = "<?php echo $website; ?>"><?php echo $website; ?></option>
                                <?php endforeach; ?>
                            </datalist>
                            <label for = "path">Or choose an existing website</label>
                            <select id = "websites-select">
                                <option value = "" selected>Choose a website:</option>
                                <?php foreach ( get_wordpress_websites() as $website ) : ?>
                                    <option value = "<?php echo $website; ?>"><?php echo $website; ?></option>
                                <?php endforeach; ?>
                            </select>

                        </div>
                        <div class = "small-column-20">
                            <br />
                            <button class = "block">Create</button>
                        </div>
                    </form>
                </section> <!-- .content -->

                <section class = "content">
                    <h2>Existing staging websites</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Url/Path</th>
                                <th>DB name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 1; ?>
                            <?php foreach ( read_websites_in_staging() as $staging ) : ?>
                                <tr>
                                    <td><?php echo $count; ?>.</td>
                                    <td><?php echo $staging; ?></td>
                                    <td>
                                        <a href = "<?php echo BASE_URL . '/' . $staging; ?>" title = "Link to staging website" target = "_blank"><?php echo BASE_URL . '/' . $staging; ?></a> <br />
                                        <small><?php echo BASE_DIRECTORY . '/' . $staging; ?></small>
                                    </td>
                                    <td><?php echo $staging; ?></td>
                                    <td class = "text-center"><a href = "?action=delete&amp;staging=<?php echo $staging; ?>" class = "button">Delete</a></td>
                                </tr>
                                <?php $count++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </section> <!-- .content -->

                <footer>
                    <p>Nevma.gr &copy;</p>
                </footer>

        </main> <!-- .wrapper -->

    </body>

</html>