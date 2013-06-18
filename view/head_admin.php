        <div class="row">
            <div class="span12">
                <div class="hero-unit">
                    <h2>Bienvenue sur le site de Météo NF17</h2>
                    <ul class="nav nav-pills">
                        <li><a href="index.php">Vue utilisateur</a></li>
                        <li class="active"><a href="admin.php">Vue administration</a></li>
                    </ul>
                </div>
                <ul class="nav nav-tabs">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Lieux<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="admin.php?ajout=ville">Ajouter une ville</a></li>
                            <li><a href="admin.php?ajout=massif">Ajouter un massif</a></li>
                            <li><a href="admin.php?list=lieu">Lister</a></li>
                            <li><a href="admin.php?list=dep">Lister les départements</a></li>
                            <li><a href="admin.php?delete=lieu">Supprimer</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Bulletins<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="admin.php?list=bulletin">Lister</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Prévisions<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="admin.php?ajout=prevision">Ajouter</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Capteurs<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="admin.php?ajout=capteur">Ajouter</a></li>
                            <li><a href="admin.php?list=capteur">Lister</a></li>
                            <li><a href="admin.php?capteur=affecter">Affecter</a></li>
                            <li><a href="admin.php?capteur=deplacer">Déplacer</a></li>
                            <li><a href="admin.php?capteur=historique">Historique</a></li>
                        </ul>
                    </li>
                </ul>
