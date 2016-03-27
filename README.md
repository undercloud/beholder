# beholder
linux process monitor

##installation
`composer require unercloud/beholder=dev-master`

##configuration

###screen
Check if `screen` and `pidof` installed, if not install it

###crontab
Add crontab job (default 2 min)  
1) open terminal  
2) type `crontab -e`  
3) add line `/2 * * * * /usr/bin/php /path/to/beholder/index.php > /dev/null 2>&1`  

###monitor
Open `/path/to/beholder/Queue.php` and add process for monitoring:

```PHP
<?php
	return [
		// section for binary files like apache, nginx, mysql
		'pidof' => [ 
			'apache2' => '/usr/sbin/apache2ctl -k start'		
		],
		//section for jobs running in screen
		'screen' => [
			'nodeserver' => 'screen -AdmS nodeserver node /path/to/script.js'
		]
	];
?>
```

###logs
Open `/path/to/beholder/Settings.php` and add path to logs in `logpath` section.