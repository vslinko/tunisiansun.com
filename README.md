# tunisiansun.com

## Installation

    git clone git://github.com/rithis/tunisiansun.com.git
    cd tunisiansun.com
    git remote add symfony-skeleton git://github.com/rithis/symfony-skeleton.git
    cp app/config/parameters.dist.yml app/config/parameters.yml
    composer.phar install
    ./app/console assets:install --symlink web
