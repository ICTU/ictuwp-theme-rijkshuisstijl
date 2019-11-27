# sh '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/wp-rijkshuisstijl/distribute.sh' &>/dev/null

# version 2.11.3a

# clear the log file

> '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/debug.log'


echo "======================================================================================"
echo "START: $(date)"


echo "copy theme --------------------------------------------------"
echo "to dev env"

rsync -r -a --delete '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/wp-rijkshuisstijl/' '/shared-paul-files/Webs/temp/'

rm -rf '/shared-paul-files/Webs/temp/.git/'
rm -rf '/shared-paul-files/Webs/temp/.codekit-cache/'
rm -rf '/shared-paul-files/Webs/temp/ignore/'

rm '/shared-paul-files/Webs/temp/.gitignore'
rm '/shared-paul-files/Webs/temp/.config.codekit3'
# rm '/shared-paul-files/Webs/temp/config.codekit3'

rm '/shared-paul-files/Webs/temp/distribute.sh'
rm '/shared-paul-files/Webs/temp/README.md'
rm '/shared-paul-files/Webs/temp/LICENSE'

# --------------------------------------------------------------------------------------------------------------------------------
# Vertalingen --------------------------------------------------------------------------------------------------------------------
# --------------------------------------------------------------------------------------------------------------------------------

echo "copy vertalingen --------------------------------------------------"
echo "to dev env"

# remove the .pot
rm '/shared-paul-files/Webs/temp/languages/wp-rijkshuisstijl.pot'


rsync -r -a --delete '/shared-paul-files/Webs/temp/languages/' '/shared-paul-files/Webs/temp_translations/'

# rename the translations
mv '/shared-paul-files/Webs/temp_translations/en_GB.po' '/shared-paul-files/Webs/temp_translations/wp-rijkshuisstijl-en_GB.po'
mv '/shared-paul-files/Webs/temp_translations/en_GB.mo' '/shared-paul-files/Webs/temp_translations/wp-rijkshuisstijl-en_GB.mo'

mv '/shared-paul-files/Webs/temp_translations/en_US.po' '/shared-paul-files/Webs/temp_translations/wp-rijkshuisstijl-en_US.po'
mv '/shared-paul-files/Webs/temp_translations/en_US.mo' '/shared-paul-files/Webs/temp_translations/wp-rijkshuisstijl-en_US.mo'

mv '/shared-paul-files/Webs/temp_translations/nl_NL.po' '/shared-paul-files/Webs/temp_translations/wp-rijkshuisstijl-nl_NL.po'
mv '/shared-paul-files/Webs/temp_translations/nl_NL.mo' '/shared-paul-files/Webs/temp_translations/wp-rijkshuisstijl-nl_NL.mo'

# --------------------------------------------------------------------------------------------------------------------------------
# copy files to /wp-content/languages/themes



echo 'vertaling naar development'
rsync -ah '/shared-paul-files/Webs/temp_translations/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/languages/themes/'

echo 'vertaling naar Dutchlogic'
rsync -ah '/shared-paul-files/Webs/temp_translations/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/live-dutchlogic/wp-content/languages/themes/'

echo 'vertaling naar Sentia acc'
rsync -ah '/shared-paul-files/Webs/temp_translations/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/sentia/accept/www/wp-content/languages/themes/'

echo 'vertaling naar Sentia live'
rsync -ah '/shared-paul-files/Webs/temp_translations/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/sentia/live/www/wp-content/languages/themes/'



# ------------------
echo "bekkuppie maken ---------------------------------------------"

rsync -r -a -v --delete '/shared-paul-files/Webs/temp/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/wp-rijkshuisstijl-accept-2.11.3a/'

# change the theme name
sed -i '.bak' 's/Rijkshuisstijl (Digitale Overheid)/2.11.3a - Widget voor no-result pagina verbeterd./g' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/wp-rijkshuisstijl-accept-2.11.3a/style.css'

# remove the backup
rm '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/wp-rijkshuisstijl-accept-2.11.3a/style.css.bak'

rsync -r -a -v --delete '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/wp-rijkshuisstijl-accept-2.11.3a/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/sentia/accept/www/wp-content/themes/XXX_oude_versies/wp-rijkshuisstijl-accept-2.11.3a/' 


# --------------------------------------------------------------------------------------------------------------------------------
cd '/shared-paul-files/Webs/temp/';
find . -name "*.map" -type f -delete;

# --------------------------------------------------------------------------------------------------------------------------------
echo "Dutchlogic --------------------------------------------------"
rsync -r -a  --delete '/shared-paul-files/Webs/temp/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/live-dutchlogic/wp-content/themes/wp-rijkshuisstijl/'

# --------------------------------------------------------------------------------------------------------------------------------
echo "Sentia Accept -----------------------------------------------"
rsync -r -a  --delete '/shared-paul-files/Webs/temp/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/sentia/accept/www/wp-content/themes/wp-rijkshuisstijl/'

# --------------------------------------------------------------------------------------------------------------------------------
echo "Sentia Live -------------------------------------------------"
rsync -r -a  --delete '/shared-paul-files/Webs/temp/' '/shared-paul-files/Webs/ICTU/Gebruiker Centraal/sentia/live/www/wp-content/themes/wp-rijkshuisstijl/'

# --------------------------------------------------------------------------------------------------------------------------------

# remove temp dirs
rm -rf '/shared-paul-files/Webs/temp/'
rm -rf '/shared-paul-files/Webs/temp_translations/'

# --------------------------------------------------------------------------------------------------------------------------------
echo "Klaar...."
