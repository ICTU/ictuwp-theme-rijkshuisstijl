# sh /shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/wp-rijkshuisstijl/distribute.sh &>/dev/null

# version 2.7.4a

# clear the log file

> '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/debug.log'


echo "======================================================================================"
echo "START: $(date)"


echo "copy theme --------------------------------------------------"
echo "to dev env"

rsync -r -a --delete '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/wp-rijkshuisstijl/' '/shared-paul-files/Webs/temp/'

rm -rf '/shared-paul-files/Webs/temp/.git/'
rm -rf '/shared-paul-files/Webs/temp/.codekit-cache/'
rm '/shared-paul-files/Webs/temp/.gitignore'
rm '/shared-paul-files/Webs/temp/config.codekit'
rm '/shared-paul-files/Webs/temp/config.codekit3'

rm '/shared-paul-files/Webs/temp/distribute.sh'
rm '/shared-paul-files/Webs/temp/README.md'
rm '/shared-paul-files/Webs/temp/LICENSE'

# --------------------------------------------------------------------------------------------------------------------------------
# Vertalingen --------------------------------------------------------------------------------------------------------------------
# --------------------------------------------------------------------------------------------------------------------------------

echo "copy vertalingen --------------------------------------------------"
echo "to dev env"

rsync -r -a --delete '/shared-paul-files/Webs/temp/languages/' '/shared-paul-files/Webs/temp_translations/'

# remove the .pot
rm '/shared-paul-files/Webs/temp/languages/wp-rijkshuisstijl.pot'

# rename the translations
mv '/shared-paul-files/Webs/temp_translations/en_GB.po' '/shared-paul-files/Webs/temp_translations/wp-rijkshuisstijl-en_GB.po'
mv '/shared-paul-files/Webs/temp_translations/en_GB.mo' '/shared-paul-files/Webs/temp_translations/wp-rijkshuisstijl-en_GB.mo'

mv '/shared-paul-files/Webs/temp_translations/en_US.po' '/shared-paul-files/Webs/temp_translations/wp-rijkshuisstijl-en_US.po'
mv '/shared-paul-files/Webs/temp_translations/en_US.mo' '/shared-paul-files/Webs/temp_translations/wp-rijkshuisstijl-en_US.mo'

mv '/shared-paul-files/Webs/temp_translations/nl_NL.po' '/shared-paul-files/Webs/temp_translations/wp-rijkshuisstijl-nl_NL.po'
mv '/shared-paul-files/Webs/temp_translations/nl_NL.mo' '/shared-paul-files/Webs/temp_translations/wp-rijkshuisstijl-nl_NL.mo'

# copy files to /wp-content/languages/themes

echo 'vertaling naar dev-env'
rsync -ah '/shared-paul-files/Webs/temp/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/languages/themes/'

echo 'vertaling naar Dutchlogic'
rsync -ah '/shared-paul-files/Webs/temp/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/live-dutchlogic/wp-content/languages/themes/'

echo 'vertaling naar Sentia acc'
rsync -ah '/shared-paul-files/Webs/temp/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/sentia/accept/www/wp-content/languages/themes/'

echo 'vertaling naar Sentia live'
rsync -ah '/shared-paul-files/Webs/temp/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/sentia/live/www/wp-content/languages/themes/'

# ------------------
# echo "bekkuppie maken ---------------------------------------------"

# rsync -r -a -v --delete '/shared-paul-files/Webs/temp/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/wp-rijkshuisstijl-accept-2.7.4a/'

# change the theme name
# sed -i '.bak' 's/Rijkshuisstijl (Digitale Overheid)/2.7.4a - Toolbox: animatie-code weggehaald en CSS bugfix voor kaderblok./g' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/wp-rijkshuisstijl-accept-2.7.4a/style.css'

# remove the backup
# rm '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/wp-rijkshuisstijl-accept-2.7.4a/style.css.bak'



# --------------------------------------------------------------------------------------------------------------------------------
echo "Dutchlogic --------------------------------------------------"


rsync -r -a  --delete '/shared-paul-files/Webs/temp/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/live-dutchlogic/wp-content/themes/wp-rijkshuisstijl/'

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


# remove temp dirs
rm -rf '/shared-paul-files/Webs/temp/'
rm -rf '/shared-paul-files/Webs/temp_translations/'



echo "Klaar...."
