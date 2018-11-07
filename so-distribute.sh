# sh /shared-paul-files/Webs/git-repos/ICTU---Digitale-Overheid-WP-theme/distribute.sh &>/dev/null

# clear the log file

> '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/debug.log'


echo "======================================================================================"
echo "START: $(date)"


echo "copy theme --------------------------------------------------"
echo "to dev env"

rsync -r -a --delete '/shared-paul-files/Webs/git-repos/ICTU---Digitale-Overheid-WP-theme/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/wp-rijkshuisstijl/'

rm -rf '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/wp-rijkshuisstijl/.git/'
rm -rf '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/wp-rijkshuisstijl/.codekit-cache/'
rm '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/wp-rijkshuisstijl/.gitignore'
rm '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/wp-rijkshuisstijl/config.codekit'
rm '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/wp-rijkshuisstijl/config.codekit3'

rm '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/wp-rijkshuisstijl/distribute.sh'
rm '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/wp-rijkshuisstijl/README.md'
rm '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/wp-rijkshuisstijl/LICENSE'

echo "kopie voor development"

rsync -r -a  --delete '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/wp-rijkshuisstijl/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/wp-rijkshuisstijl-development/'

echo "css aanpassen in development versie"

# change the theme name
sed -i '.bak' 's/Theme Name: Rijkshuisstijl (Digitale Overheid)/Theme Name: Rijkshuisstijl Digitale Overheid (development)/g' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/wp-rijkshuisstijl-development/style.css'

# zet sowieso voor de stable versie CSS debug uit
# sed -i '.bak' 's/"SHOW_CSS_DEBUG",                   true/"SHOW_CSS_DEBUG",                   false/g' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/wp-rijkshuisstijl/functions.php'



# remove the backup
rm '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/wp-rijkshuisstijl-development/style.css.bak'

# remove the backup
rm '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/wp-rijkshuisstijl-development/screenshot.png'

# for the development version use the development screenshot
mv '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/wp-rijkshuisstijl-development/screenshot_development.png' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/wp-rijkshuisstijl-development/screenshot.png'


# remove development screenshot from the stable version
rm '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/wp-rijkshuisstijl/screenshot_development.png'



echo "Dutchlogic --------------------------------------------------"


rsync -r -a  --delete '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/wp-rijkshuisstijl/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/live-dutchlogic/wp-content/themes/wp-rijkshuisstijl/'

rsync -r -a  --delete '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/wp-rijkshuisstijl-development/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/live-dutchlogic/wp-content/themes/wp-rijkshuisstijl-development/'


echo "DO single site ----------------------------------------------"

rsync -r -a  --delete '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/live-dutchlogic/wp-content/themes/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/do-singlesite/wp-content/themes/'

echo "Sentia Accept -----------------------------------------------"

rsync -r -a  --delete '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/live-dutchlogic/wp-content/themes/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/sentia/accept/www/wp-content/themes/'

echo "Sentia Live -------------------------------------------------"
rsync -r -a  --delete '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/live-dutchlogic/wp-content/themes/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/sentia/live/www/wp-content/themes/'

echo "Klaar...."
