<?php
/*
 *  ISPConfig v3.1+ module for WHMCS v7.x or Higher
 *  Copyright (C) 2014 - 2018  Shane Chrisp
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

use WHMCS\Database\Capsule;

add_hook('ClientAreaSidebars', 1, function($vars) {
    
/*
 * Get Site.pro and filemanager settings from Database.
 */
$prodid = Capsule::table('tblhosting')
        ->select('packageid')
        ->where('id', $_GET['id'])
        ->get();

$confd = Capsule::table('tblproducts')
        ->where('id', $prodid[0]->packageid)
        ->get();

    if (function_exists('cwispy_handle_view')) {
        $currentRequest = $_GET;

        $primarySidebar = Menu::primarySidebar();
        $secondarySidebar = Menu::secondarySidebar();
		//$submodsettings        = explode( ',',$params['configoption11'] );
		//$submodsettings[0]

        $accountMenu = $primarySidebar->addChild(
            'ispcfg3 ISPConfig Account Nav',
            array(
                'label' => (Lang::trans('ispcfg3_product_tools')),
                'order' => 10,
                'icon' => 'fa-cog',
            )
        );

        $accountMenu->addChild('Overview')
            ->setUri(cwispy_create_url(array('view' => 'overview')))
            ->setLabel(Lang::trans('ispcfg3_product_details'))
            ->setOrder(1)
            ->setIcon('fa-info-circle')
            ->setClass(cwispy_get_menu_item_class($currentRequest, array('view' => 'overview')));
        
if ( !empty( $confd[0]->configoption17 ) || ( $confd[0]->configoption17 != '' ) ) {
		$accountMenu->addChild('Site Builder')
            ->setUri(cwispy_create_url(array('view' => 'sitebuilder')))
            ->setLabel('Site Builder')
            ->setOrder(1)
            ->setIcon('fa-pencil-square-o')
            ->setClass(cwispy_get_menu_item_class($currentRequest, array('view' => 'sitebuilder')));
}
if ( !empty( $confd[0]->configoption18 ) || ( $confd[0]->configoption18 != '' ) ) {
        $accountMenu->addChild('File Manager')
            ->setUri(cwispy_create_url(array('view' => 'file-manager')))
            ->setLabel(Lang::trans('ispcfg3_file_manager'))
            ->setOrder(3)
            ->setIcon('fa-file')
            ->setClass(cwispy_get_menu_item_class($currentRequest, array('view' => 'file-manager')));
}
        $accountMenu->addChild('Emails')
            ->setUri(cwispy_create_url(array('view' => 'emails')))
            ->setLabel(Lang::trans('ispcfg3_emails'))
            ->setOrder(4)
            ->setIcon('fa-envelope')
            ->setClass(cwispy_get_menu_item_class($currentRequest, array('view' => 'emails')));
		
        
        $accountMenu->addChild('Email Forwarders')
            ->setUri(cwispy_create_url(array('view' => 'email-forwarders')))
            ->setLabel(Lang::trans('ispcfg3_email_forwarders'))
            ->setOrder(5)
            ->setIcon('fa-forward')
            ->setClass(cwispy_get_menu_item_class($currentRequest, array('view' => 'email-forwarders')));
		
        
        $accountMenu->addChild('FTP Accounts')
            ->setUri(cwispy_create_url(array('view' => 'ftp-accounts')))
            ->setLabel(Lang::trans('ispcfg3_ftp_accounts'))
            ->setOrder(6)
            ->setIcon('fa-files-o')
            ->setClass(cwispy_get_menu_item_class($currentRequest, array('view' => 'ftp-accounts')));
		
        
        $accountMenu->addChild('Databases')
            ->setUri(cwispy_create_url(array('view' => 'databases')))
            ->setLabel(Lang::trans('ispcfg3_databases'))
            ->setOrder(7)
            ->setIcon('fa-database')
            ->setClass(cwispy_get_menu_item_class($currentRequest, array('view' => 'databases')));
			
        $accountMenu->addChild('Websites')
            ->setUri(cwispy_create_url(array('view' => 'websites')))
            ->setLabel(Lang::trans('ispcfg3_websites'))
            ->setOrder(8)
            ->setIcon('fa-desktop')
            ->setClass(cwispy_get_menu_item_class($currentRequest, array('view' => 'websites')));
        
        $accountMenu->addChild('Alias Domains')
            ->setUri(cwispy_create_url(array('view' => 'aliasdomains')))
            ->setLabel(Lang::trans('ispcfg3_alias_domains'))
            ->setOrder(9)
            ->setIcon('fa-plus-circle')
            ->setClass(cwispy_get_menu_item_class($currentRequest, array('view' => 'aliasdomains')));
	
        
        $accountMenu->addChild('Sub Domains')
            ->setUri(cwispy_create_url(array('view' => 'subdomains')))
            ->setLabel(Lang::trans('ispcfg3_sub_domains'))
            ->setOrder(10)
            ->setIcon('fa-sitemap')
            ->setClass(cwispy_get_menu_item_class($currentRequest, array('view' => 'subdomains')));
		
        
        $accountMenu->addChild('Cron Jobs')
            ->setUri(cwispy_create_url(array('view' => 'cron')))
            ->setLabel(Lang::trans('ispcfg3_cron_jobs'))
            ->setOrder(11)
            ->setIcon('fa-clock-o')
            ->setClass(cwispy_get_menu_item_class($currentRequest, array('view' => 'cron')));
		
        
        $accountMenu->addChild('DNS Records')
            ->setUri(cwispy_create_url(array('view' => 'dns')))
            ->setLabel(Lang::trans('ispcfg3_dns_records'))
            ->setOrder(12)
            ->setIcon('fa-external-link')
            ->setClass(cwispy_get_menu_item_class($currentRequest, array('view' => 'dns')));
			
        
		$accountMenu->addChild('Usage Statistics')
            ->setUri(cwispy_create_url(array('view' => 'usage')))
            ->setLabel(Lang::trans('ispcfg3_usage_stats'))
            ->setOrder(13)
            ->setIcon('fa-area-chart')
            ->setClass(cwispy_get_menu_item_class($currentRequest, array('view' => 'usage')));
	
	
        $loginMenu = $primarySidebar->addChild(
            'iHost ISPConfig Login Nav',
            array(
                'label' => (Lang::trans('ispcfg3_login_to')),
                'order' => 14,
                'icon' => 'fa-lock',
            )
        );
		
		$loginMenu->addChild('View Statistics')
            ->setUri(cwispy_create_url(array('view' => 'login', 'view_action' => 'stats')))
            ->setLabel(Lang::trans('ispcfg3_website_statistics'))
            ->setOrder(2)
            ->setIcon('fa-bar-chart')
            ->setAttribute('target', '_blank');
	
	
        $loginMenu->addChild('Webmail')
            ->setUri(cwispy_create_url(array('view' => 'login', 'view_action' => 'webmail')))
            ->setLabel('Webmail')
            ->setOrder(3)
            ->setIcon('fa-envelope')
            ->setAttribute('target', '_blank');
	
        
        $loginMenu->addChild('phpMyAdmin')
            ->setUri(cwispy_create_url(array('view' => 'login', 'view_action' => 'phpmyadmin')))
            ->setLabel('phpMyAdmin')
            ->setOrder(4)
            ->setIcon('fa-database')
            ->setAttribute('target', '_blank');
    
	}
});

add_hook('ClientAreaFooterOutput', 1, function($vars) {
    if (function_exists('cwispy_handle_view')) {
        $script = '
        <script type="text/javascript" src="'.$vars['WEB_ROOT'].'/modules/servers/ispcfg3/assets/js/ajax.js"></script>
        <script type="text/javascript" src="'.$vars['WEB_ROOT'].'/modules/servers/ispcfg3/assets/js/script.js"></script>
        ';
        return $script;
    }
});
