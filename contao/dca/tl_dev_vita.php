<?php
use Contao\DC_Table;

$GLOBALS['TL_DCA']['tl_dev_vita'] = [
    'config' => [
        'dataContainer' => DC_Table::class,
        'sql' => ['keys' => ['id' => 'primary']],
    ],
    'list' => [
        'sorting' => [
            'mode' => 1,
            'fields' => ['sorting'],
            'flag' => 1,
            'panelLayout' => 'filter;search,limit',
        ],
        'label' => [
            'fields' => ['repository', 'branch'],
            'format' => '%s [%s]',
        ],
    ],
    'palettes' => [
     
        'default' => '{general_legend},contributor,repository,branch,repo_type,token,created_at',
        
    ],
    'fields' => [
        'id' => ['sql' => "int(10) unsigned NOT NULL auto_increment"],
        'tstamp' => ['sql' => "int(10) unsigned NOT NULL default '0'"],

        'contributor' => [
            'label' => ['Contributor', 'GitHub Benutzer'],
            'inputType' => 'text',
            'eval' => ['mandatory' => true, 'maxlength' => 255],
            'sql' => "varchar(255) NOT NULL default ''"
        ],
        'repository' => [
            'label' => ['Repository', 'Repository-Name auf GitHub'],
            'inputType' => 'text',
            'eval' => ['mandatory' => true, 'maxlength' => 255],
            'sql' => "varchar(255) NOT NULL default ''"
        ],
        'branch' => [
            'label' => ['Branch/Version'],
            'inputType' => 'text',
            'eval' => ['mandatory' => true, 'maxlength' => 255],
            'sql' => "varchar(255) NOT NULL default 'main'"
        ],
        'repo_type' => [
            'label' => ['Repo-Typ'],
            'inputType' => 'select',
            'options' => ['public', 'private'],
            'eval' => ['mandatory' => true, 'includeBlankOption' => true, 'submitOnChange' => true],
            'sql' => "varchar(10) NOT NULL default 'public'"
        ],
        'token' => [
            'label' => ['GitHub Access Token'],
            'inputType' => 'text',
            'eval' => ['maxlength' => 255, 'decodeEntities' => true],
            'sql' => "varchar(255) NOT NULL default ''"
        ],
        'created_at' => [
            'label' => ['Erstellungsdatum'],
            'inputType' => 'text',
            'eval' => ['rgxp' => 'date', 'datepicker' => true],
            'sql' => "varchar(32) NOT NULL default ''"
        ],
        'sorting' => [
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ]
    ]
];
