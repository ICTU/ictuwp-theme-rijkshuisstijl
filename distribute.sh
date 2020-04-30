# shortcode: 'ictudo'
# sh '/Users/paul/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/wp-rijkshuisstijl/distribute.sh' &>/dev/null

# version 2.15.1

# clear the log file

> '/Users/paul/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/debug.log'


echo "======================================================================================"
echo "START: $(date)"


echo "copy theme --------------------------------------------------"
echo "to dev env"

rsync -r -a --delete '/Users/paul/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/wp-rijkshuisstijl/' '/Users/paul/shared-paul-files/Webs/temp/'

rm -rf '/Users/paul/shared-paul-files/Webs/temp/.git/'
rm -rf '/Users/paul/shared-paul-files/Webs/temp/.codekit-cache/'
rm -rf '/Users/paul/shared-paul-files/Webs/temp/ignore/'

rm '/Users/paul/shared-paul-files/Webs/temp/.gitignore'
rm '/Users/paul/shared-paul-files/Webs/temp/.config.codekit3'
# rm '/Users/paul/shared-paul-files/Webs/temp/config.codekit3'

rm '/Users/paul/shared-paul-files/Webs/temp/distribute.sh'
rm '/Users/paul/shared-paul-files/Webs/temp/README.md'
rm '/Users/paul/shared-paul-files/Webs/temp/LICENSE'

# --------------------------------------------------------------------------------------------------------------------------------
# Vertalingen --------------------------------------------------------------------------------------------------------------------
# --------------------------------------------------------------------------------------------------------------------------------

echo "copy vertalingen --------------------------------------------------"
echo "to dev env"

# remove the .pot
rm '/Users/paul/shared-paul-files/Webs/temp/languages/wp-rijkshuisstijl.pot'


rsync -r -a --delete '/Users/paul/shared-paul-files/Webs/temp/languages/' '/Users/paul/shared-paul-files/Webs/temp_translations/'

# rename the translations
mv '/Users/paul/shared-paul-files/Webs/temp_translations/en_GB.po' '/Users/paul/shared-paul-files/Webs/temp_translations/wp-rijkshuisstijl-en_GB.po'
mv '/Users/paul/shared-paul-files/Webs/temp_translations/en_GB.mo' '/Users/paul/shared-paul-files/Webs/temp_translations/wp-rijkshuisstijl-en_GB.mo'

mv '/Users/paul/shared-paul-files/Webs/temp_translations/en_US.po' '/Users/paul/shared-paul-files/Webs/temp_translations/wp-rijkshuisstijl-en_US.po'
mv '/Users/paul/shared-paul-files/Webs/temp_translations/en_US.mo' '/Users/paul/shared-paul-files/Webs/temp_translations/wp-rijkshuisstijl-en_US.mo'

mv '/Users/paul/shared-paul-files/Webs/temp_translations/nl_NL.po' '/Users/paul/shared-paul-files/Webs/temp_translations/wp-rijkshuisstijl-nl_NL.po'
mv '/Users/paul/shared-paul-files/Webs/temp_translations/nl_NL.mo' '/Users/paul/shared-paul-files/Webs/temp_translations/wp-rijkshuisstijl-nl_NL.mo'

## # copy the translations for the blue theme
## cp '/Users/paul/shared-paul-files/Webs/temp_translations/wp-rijkshuisstijl-en_GB.po' '/Users/paul/shared-paul-files/Webs/temp_translations/wp-rijkshuisstijl-wp-rijkshuisstijl-blauw-en_GB.po'
## cp '/Users/paul/shared-paul-files/Webs/temp_translations/wp-rijkshuisstijl-en_GB.mo' '/Users/paul/shared-paul-files/Webs/temp_translations/wp-rijkshuisstijl-wp-rijkshuisstijl-blauw-en_GB.mo'
## 
## cp '/Users/paul/shared-paul-files/Webs/temp_translations/wp-rijkshuisstijl-en_US.po' '/Users/paul/shared-paul-files/Webs/temp_translations/wp-rijkshuisstijl-wp-rijkshuisstijl-blauw-en_US.po'
## cp '/Users/paul/shared-paul-files/Webs/temp_translations/wp-rijkshuisstijl-en_US.mo' '/Users/paul/shared-paul-files/Webs/temp_translations/wp-rijkshuisstijl-wp-rijkshuisstijl-blauw-en_US.mo'
## 
## cp '/Users/paul/shared-paul-files/Webs/temp_translations/wp-rijkshuisstijl-nl_NL.po' '/Users/paul/shared-paul-files/Webs/temp_translations/wp-rijkshuisstijl-wp-rijkshuisstijl-blauw-nl_NL.po'
## cp '/Users/paul/shared-paul-files/Webs/temp_translations/wp-rijkshuisstijl-nl_NL.mo' '/Users/paul/shared-paul-files/Webs/temp_translations/wp-rijkshuisstijl-wp-rijkshuisstijl-blauw-nl_NL.mo'


# --------------------------------------------------------------------------------------------------------------------------------
# copy files to /wp-content/languages/themes

echo 'vertaling naar development'
rsync -ah '/Users/paul/shared-paul-files/Webs/temp_translations/' '/Users/paul/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/languages/themes/'

echo 'vertaling naar Sentia acc'
rsync -ah '/Users/paul/shared-paul-files/Webs/temp_translations/' '/Users/paul/shared-paul-files/Webs/ICTU/Gebruiker Centraal/sentia/accept/www/wp-content/languages/themes/'

echo 'vertaling naar Sentia live'
rsync -ah '/Users/paul/shared-paul-files/Webs/temp_translations/' '/Users/paul/shared-paul-files/Webs/ICTU/Gebruiker Centraal/sentia/live/www/wp-content/languages/themes/'

# ------------------
echo "bekkuppie maken ---------------------------------------------"

rsync -r -a -v --delete '/Users/paul/shared-paul-files/Webs/temp/' '/Users/paul/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/xxx_old_versions/wp-rijkshuisstijl-versie-2.15.1/'

# change the theme name
sed -i '.bak' "s/Rijkshuisstijl (Digitale Overheid)/2.15.1 - Social media-deelknoppen weggehaald./g" '/Users/paul/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/xxx_old_versions/wp-rijkshuisstijl-versie-2.15.1/style.css'

# remove the backup
rm '/Users/paul/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/xxx_old_versions/wp-rijkshuisstijl-versie-2.15.1/style.css.bak'

rsync -r -a -v --delete '/Users/paul/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/xxx_old_versions/wp-rijkshuisstijl-versie-2.15.1/' '/Users/paul/shared-paul-files/Webs/ICTU/Gebruiker Centraal/sentia/live/www/wp-content/themes/XXX_oude_versies/wp-rijkshuisstijl-versie-2.15.1/' 

rsync -r -a -v --delete '/Users/paul/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/xxx_old_versions/wp-rijkshuisstijl-versie-2.15.1/' '/Users/paul/shared-paul-files/Webs/ICTU/Gebruiker Centraal/sentia/accept/www/wp-content/themes/XXX_oude_versies/wp-rijkshuisstijl-versie-2.15.1/' 

## go to development folder
cd '/Users/paul/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/xxx_old_versions/';

## create a tar ball
tar czf wp-rijkshuisstijl-versie-2.15.1.tar.gz 'wp-rijkshuisstijl-versie-2.15.1'

## remove the folder
rm -rf '/Users/paul/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/xxx_old_versions/wp-rijkshuisstijl-versie-2.15.1/'

# --------------------------------------------------------------------------------------------------------------------------------
cd '/Users/paul/shared-paul-files/Webs/temp/';
find . -name "*.map" -type f -delete;


# --------------------------------------------------------------------------------------------------------------------------------
# blauwe kopie maken
rsync -r -a -v --delete '/Users/paul/shared-paul-files/Webs/temp/' '/Users/paul/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/wp-rijkshuisstijl-blauw/'

# change the theme name
sed -i '.bak' "s/Rijkshuisstijl (Digitale Overheid)/Rijkshuisstijl Blauw (flitspanel)/g" '/Users/paul/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/wp-rijkshuisstijl-blauw/style.css'

# donkergroen vervangengen door donkerblauw
# @donkergroen_vol -> @donkerblauw_vol
sed -i '.bak' "s/#275937/#01689b/g" '/Users/paul/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/wp-rijkshuisstijl-blauw/style.css'
# donkergroen vervangengen door donkerblauw
# @donkergroen_licht -> @donkerblauw_licht
sed -i '.bak' "s/#becdc3/#cce0f1/g" '/Users/paul/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/wp-rijkshuisstijl-blauw/style.css'

# donkergroen vervangengen door donkerblauw
# @donkergroen_lichtst -> @donkerblauw_lichtst
sed -i '.bak' "s/#dfe6e1/#e5f0f9/g" '/Users/paul/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/wp-rijkshuisstijl-blauw/style.css'


rm '/Users/paul/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/wp-rijkshuisstijl-blauw/style.css.bak'



# --------------------------------------------------------------------------------------------------------------------------------
echo "Sentia Accept -----------------------------------------------"
rsync -r -a  --delete '/Users/paul/shared-paul-files/Webs/temp/' '/Users/paul/shared-paul-files/Webs/ICTU/Gebruiker Centraal/sentia/accept/www/wp-content/themes/wp-rijkshuisstijl/'
rsync -r -a  --delete '/Users/paul/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/wp-rijkshuisstijl-blauw/' '/Users/paul/shared-paul-files/Webs/ICTU/Gebruiker Centraal/sentia/accept/www/wp-content/themes/wp-rijkshuisstijl-blauw/'

# --------------------------------------------------------------------------------------------------------------------------------
echo "Sentia Live -------------------------------------------------"
rsync -r -a  --delete '/Users/paul/shared-paul-files/Webs/temp/' '/Users/paul/shared-paul-files/Webs/ICTU/Gebruiker Centraal/sentia/live/www/wp-content/themes/wp-rijkshuisstijl/'
rsync -r -a  --delete '/Users/paul/shared-paul-files/Webs/ICTU/Gebruiker Centraal/development/wp-content/themes/wp-rijkshuisstijl-blauw/' '/Users/paul/shared-paul-files/Webs/ICTU/Gebruiker Centraal/sentia/live/www/wp-content/themes/wp-rijkshuisstijl-blauw/'

# --------------------------------------------------------------------------------------------------------------------------------

# remove temp dirs
rm -rf '/Users/paul/shared-paul-files/Webs/temp/'
rm -rf '/Users/paul/shared-paul-files/Webs/temp_translations/'

# --------------------------------------------------------------------------------------------------------------------------------
echo "Klaar...."
