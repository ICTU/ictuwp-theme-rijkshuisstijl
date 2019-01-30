# sh /shared-paul-files/Webs/git-repos/ICTU---Digitale-Overheid-WP-theme/distribute.sh &>/dev/null

# version 2.2.5b

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

# --------------------------------------------------------------------------------------------------------------------------------
# Vertalingen --------------------------------------------------------------------------------------------------------------------
# --------------------------------------------------------------------------------------------------------------------------------

rsync -r -a --delete '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/wp-rijkshuisstijl/languages/' '/shared-paul-files/Webs/temp/'

# remove the .pot
rm '/shared-paul-files/Webs/temp/wp-rijkshuisstijl.pot'

# remove the translations
mv '/shared-paul-files/Webs/temp/en_US.po' '/shared-paul-files/Webs/temp/wp-rijkshuisstijl-en_US.po'
mv '/shared-paul-files/Webs/temp/en_US.mo' '/shared-paul-files/Webs/temp/wp-rijkshuisstijl-en_US.mo'

mv '/shared-paul-files/Webs/temp/nl_NL.po' '/shared-paul-files/Webs/temp/wp-rijkshuisstijl-nl_NL.po'
mv '/shared-paul-files/Webs/temp/nl_NL.mo' '/shared-paul-files/Webs/temp/wp-rijkshuisstijl-nl_NL.mo'

# copy files to /wp-content/languages/themes
rsync -ah '/shared-paul-files/Webs/temp/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/languages/themes/'

# --------------------------------------------------------------------------------------------------------------------------------
echo "bekkuppie maken ---------------------------------------------"
# --------------------------------------------------------------------------------------------------------------------------------

rsync -r -a -v --delete '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/wp-rijkshuisstijl/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/wp-rijkshuisstijl-accept-2.2.5b/'

# change the theme name
sed -i '.bak' 's/Rijkshuisstijl (Digitale Overheid)/2.2.5b - Kleursuggestie Pim voor donkerder oranje./g' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/wp-rijkshuisstijl-accept-2.2.5b/style.css'

# remove the backup
rm '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/wp-rijkshuisstijl-accept-2.2.5b/style.css.bak'



# --------------------------------------------------------------------------------------------------------------------------------
echo "Dutchlogic --------------------------------------------------"


rsync -r -a  --delete '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/wp-rijkshuisstijl/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/live-dutchlogic/wp-content/themes/wp-rijkshuisstijl/'

cd '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/live-dutchlogic/wp-content/themes/wp-rijkshuisstijl/';

find . -name "*.map" -type f -delete;

# copy files to /wp-content/languages/themes
rsync -ah '/shared-paul-files/Webs/temp/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/live-dutchlogic/wp-content/languages/themes/'



# --------------------------------------------------------------------------------------------------------------------------------
echo "DO single site ----------------------------------------------"

# copy files to /wp-content/languages/themes
rsync -ah '/shared-paul-files/Webs/temp/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/do-singlesite/wp-content/languages/themes/'
rsync -r -a  --delete '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/live-dutchlogic/wp-content/themes/wp-rijkshuisstijl/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/do-singlesite/wp-content/themes/wp-rijkshuisstijl/'

# --------------------------------------------------------------------------------------------------------------------------------
echo "Sentia Accept -----------------------------------------------"

# copy files to /wp-content/languages/themes
rsync -ah '/shared-paul-files/Webs/temp/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/sentia/accept/www/wp-content/languages/themes/'
rsync -r -a  --delete '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/live-dutchlogic/wp-content/themes/wp-rijkshuisstijl/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/sentia/accept/www/wp-content/themes/wp-rijkshuisstijl/'

# --------------------------------------------------------------------------------------------------------------------------------
echo "Sentia Live -------------------------------------------------"
rsync -ah '/shared-paul-files/Webs/temp/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/sentia/live/www/wp-content/languages/themes/'
rsync -r -a  --delete '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/live-dutchlogic/wp-content/themes/wp-rijkshuisstijl/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/sentia/live/www/wp-content/themes/wp-rijkshuisstijl/'


# remove temp dir
rm -rf '/shared-paul-files/Webs/temp/'



echo "Klaar...."