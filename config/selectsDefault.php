<?php

return [
    // 'conditions' => [
    //     0 =>  [
    //         'label' => 'Identidad y patrimonios culturales', 'value' => 'IPC'
    //     ],
    //     1 =>  [
    //         'label' => 'Referencias a comunidades culturales', 'value' => 'RCC'
    //     ],
    //     2 =>  [
    //         'label' => 'Acceso y participación en la vida cultural', 'value' => 'APVC'
    //     ],
    //     3 =>  [
    //         'label' => 'Educación y formación', 'value' => 'EF'
    //     ],
    //     4 => [
    //         'label' =>  'Información y comunicación', 'value' => 'IC'
    //     ],
    //     5 =>  [
    //         'label' => 'Cooperación cultural', 'value' => 'CC'
    //     ]
    // ],
    'conditions' => [
        0 =>  [
            "label" => "Desplazado/a", 'value' => 'D'
        ],
        1 =>  [
            "label" => "Mujer cabeza de hogar", 'value' => 'MCH'
        ],
        2 =>  [
            "label" => "Victima del conflicto interno", 'value' => 'CI'
        ],
        3 =>  [
            "label" => "Otros hechos", 'value' => 'OH'
        ],
        4 =>   [
            "label" => "No aplica", 'value' => 'NA'
        ]
    ],
    'disability_types' => [
        0 =>  [
            'label' => 'Física', 'value' => 'F'
        ],
        1 =>  [
            'label' => 'Visual', 'value' => 'V'
        ],
        2 =>  [
            'label' => 'Auditiva', 'value' => 'A'
        ],
        3 =>  [
            'label' => 'Cognitiva', 'value' => 'C'
        ],
        4 =>  [
            'label' => 'Mental', 'value' => 'M'
        ],
        5 =>  [
            'label' => 'Múltiple', 'value' => 'MUL'
        ],
        6 =>  [
            'label' => 'Otra, cual?', 'value' => 'O'
        ]
    ],
    'educational_levels' => [
        0 =>  [
            'label' => 'Preescolar', 'value' => 'PREE'
        ],
        1 =>  [
            'label' => 'Primaria', 'value' => 'PRI'
        ],
        2 =>  [
            'label' => 'Bachillerato', 'value' => 'BAC'
        ],
        3 =>  [
            'label' => 'Técnico', 'value' => 'TEC'
        ],
        4 =>  [
            'label' => 'Tecnólogo', 'value' => 'TECN'
        ],
        5 =>  [
            'label' => 'Pregrado', 'value' => 'PRE'
        ],
        6 =>  [
            'label' => 'Posgrado', 'value' => 'POS'
        ],
        7 =>  [
            'label' => 'Ninguno', 'value' => 'N'
        ],
    ],
    'ethnicities' => [
        0 =>  [
            'label' => 'Afrodescendiente', 'value' => 'AFRO'
        ],
        1 =>  [
            'label' => 'Indígena', 'value' => 'IND'
        ],
        2 =>  [
            'label' => 'ROM(Gitana)', 'value' => 'ROM'
        ],
        3 =>  [
            'label' => 'Palenquero', 'value' => 'PAL'
        ],
        4 =>  [
            'label' => 'Raizal', 'value' => 'RAI'
        ],
        5 =>  [
            'label' => 'Negro', 'value' => 'NEG'
        ],
        6 =>  [
            'label' => 'Ninguno', 'value' => 'N'
        ]
    ],
    'genders' => [
        0 =>  [
            'label' => 'Masculino', 'value' => 'M'
        ],
        1 =>  [
            'label' => 'Femenino', 'value' => 'F'
        ],
        2 =>  [
            'label' => 'LGBTIQ+', 'value' => 'LGBTIQ+'
        ],
        3 => [
            'label' =>  'Otro', 'value' => 'O'
        ]
    ],
    'health_conditions' => [
        0 =>  [
            'label' => 'Bueno', 'value' => 'B'
        ],
        1 =>  [
            'label' => 'Regular', 'value' => 'R'
        ],
        2 =>  [
            'label' => 'Malo', 'value' => 'M'
        ]
    ],
    'lineaments' => [
        0 =>  [
            'label' => 'Diálogo cultural', 'value' => 'DC'
        ],
        1 =>  [
            'label' => 'Enfoque diferencial', 'value' => 'EF'
        ],
        2 =>  [
            'label' => 'Acción sin daño', 'value' => 'AD'
        ],
        3 =>  [
            'label' => 'Cultura como entorno protector', 'value' => 'CEP'
        ],
        4 =>  [
            'label' => 'Ecosistema de paz', 'value' => 'EP'
        ]
    ],

    'linkage_projects' => [
        0 => [
            'label' => 'Por medio de una Institución educativa',
            'value' => 'PMIE'
        ],
        1 => [
            'label' => 'Por medio de una Entidad pública',
            'value' =>  'PMEPUB'
        ],
        2 => [
            'label' => 'Por medio de una Entidad privada',
            'value' => 'PMEPRI'
        ],
        3 => [
            'label' => 'Por medio de un gestor cultural del proyecto',
            'value' => 'PMGCP'
        ],
        4 => [
            'label' => 'Por medio de un monitor cultural del proyecto',
            'value' => 'PMMCP'
        ],
        5 => [
            'label' => 'Por medio de un referido',
            'value' => 'PMR'
        ]
    ],
    'medical_services' => [
        0 =>  [
            'label' => 'Subsidiado',
            'value' => 'S'
        ],
        1 =>  [
            'label' => 'Contributivo',
            'value' => 'C'
        ]
    ],
    'participant_types' => [
        0 =>  [
            'label' => 'Caracterizado',
            'value' => 'C'
        ],
        1 =>  [
            'label' => 'No caracterizado',
            'value' => 'NC'
        ]
    ],
    'decisions' => [

        0 => [
            'label' => 'Si', 'value' => '1'
        ],
        1 => [
            'label' => 'No', 'value' => '0'
        ]
    ],
    'relatives' => [
        0 => [
            'label' => 'Mamá', 'value' => 'M'
        ],
        1 => [
            'label' => 'Papá', 'value' => 'P'
        ],
        2 =>  [
            'label' => 'Tio(a)', 'value' => 'T'
        ],
        3 =>  [
            'label' => 'Primo(a)', 'value' => 'PR'
        ],
        4 =>  [
            'label' => 'Hermano(a)', 'value' => 'H'
        ],
        5 =>  [
            'label' => 'Abuelo(a)', 'value' => 'A'
        ]
    ],
    'stratums' => [
        0 => [
            'label' =>  '1',
            'value' => 1
        ],
        1 => [
            'label' =>  '2',
            'value' => 2
        ],
        2 =>  [
            'label' => '3',
            'value' => 3
        ],
        3 =>  [
            'label' => '4',
            'value' => 4
        ],
        4 =>  [
            'label' => '5',
            'value' => 5
        ],
        5 =>  [
            'label' => '6',
            'value' => 6
        ]
    ],

    'type_documents' => [
        0 =>  [
            'label' => 'Registro civil',
            'value' => 'RC'
        ],
        1 =>  [
            'label' => 'Tarjeta de identidad',
            'value' => 'TI'
        ],
        2 =>   [
            'label' => 'Cédula de ciudadania',
            'value' => 'CC'
        ]
    ],
    'zones' => [
        0 =>  [
            'label' => 'Rural', 'value' => 'R'
        ],
        1 =>  [
            'label' => 'Urbano', 'value' => 'U'
        ]
    ],
    'status' => [
        0 =>  [
            'label' => 'RECHAZADO', 'value' => 'REC'
        ],
        1 =>  [
            'label' => 'REVISADO', 'value' => 'REV'
        ],
        2 =>  [
            'label' => 'EN REVISIÓN', 'value' => 'ENREV'
        ],
        3 =>  [
            'label' => 'APROBADO', 'value' => 'APRO'
        ]

    ],
    'binnacles' => [
        0 =>  [
            'label' => 'JORNADA PACTO', 'value' => 'JP'
        ],
        1 =>  [
            'label' => 'SEMILLERO CULTURAL', 'value' => 'SC'
        ],
        2 =>  [
            'label' => 'ACTIVACIÓN CULTURAL', 'value' => 'AC'
        ],
        3 =>  [
            'label' => 'TAPETE METODOLÓGICO', 'value' => 'TP'
        ],
        4 =>  [
            'label' => 'ENSAMBLE CULTURAL', 'value' => 'EC'
        ]

    ],
    'place_types' => [
        0 =>  [
            'label' => 'FUNDACIÓN', 'value' => 'F'
        ],
        1 =>  [
            'label' => 'PARQUE', 'value' => 'P'
        ],
        2 =>  [
            'label' => 'SALÓN COMUNAL', 'value' => 'SC'
        ],
        3 =>  [
            'label' => 'COLEGIO EN CONTRAJORNADA', 'value' => 'CEC'
        ],
        4 =>  [
            'label' => 'OTRO', 'value' => 'O'
        ]
    ],
    'activation_mode' => [
        0 =>  [
            'label' => 'Virtual', 'value' => 'virtual'
        ],
        1 =>  [
            'label' => 'Presencial', 'value' => 'presencial'
        ],

    ],

    'disease_types' => [
        0 =>  [
            'label' => 'Cardiovascular', 'value' => 'CV'
        ],
        1 =>  [
            'label' => 'Respiratorio', 'value' => 'R'
        ],
        2 =>  [
            'label' => 'Osteomuscular', 'value' => 'OM'
        ],
        3 =>  [
            'label' => 'Neurológica', 'value' => 'N'
        ],
        4 =>  [
            'label' => 'Otra, cual?', 'value' => 'O'
        ],
    ],
    'marital_status' => [
        0 =>  [
            'label' => 'Soltero', 'value' => 'CV'
        ],
        1 =>  [
            'label' => 'Casado', 'value' => 'R'
        ],
        2 =>  [
            'label' => 'Unión libre', 'value' => 'UL'
        ],
        3 =>  [
            'label' => 'Divorciado', 'value' => 'D'
        ],
        4 =>  [
            'label' => 'Viudo', 'value' => 'V'
        ],
    ],
    'relationship_households' => [
        0 =>  [
            'label' => 'Esposo(a)', 'value' => 'E'
        ],
        1 =>  [
            'label' => 'Hijo(a)', 'value' => 'H'
        ],
        2 =>  [
            'label' => 'Jefe de hogar', 'value' => 'JH'
        ],
        3 =>  [
            'label' => 'Familiar', 'value' => 'F'
        ]
    ],
    'single_registry_victims' => [
        0 =>  [
            'label' => 'Si', 'value' => 'S'
        ],
        1 =>  [
            'label' => 'No', 'value' => 'N'
        ],
        2 =>  [
            'label' => 'No sabe', 'value' => 'NS'
        ],
        3 =>  [
            'label' => 'No aplica', 'value' => 'NA'
        ]
    ],
    'type_diseases' => [
        0 => [
            'label' => 'Infecciosa', 'value' => 'I'
        ],
        1 => [
            'label' => 'Mentales', 'value' => 'M'
        ],
        2 => [
            'label' => 'Respiratorias', 'value' => 'R'
        ],
        3 => [
            'label' => 'Circulatorias', 'value' => 'C'
        ],
        4 => [
            'label' => 'Sanguineas', 'value' => 'S'
        ],
        5 => [
            'label' => 'Nutricionales', 'value' => 'N'
        ],
        6 => [
            'label' => 'Endocrinas', 'value' => 'E'
        ],
    ],
    'beneficiary_attrition_factors' => [
        0 => [
            'label' => 'Problemas familiares', 'value' => 'PF'
        ],
        1 => [
            'label' => 'Problemas económicos', 'value' => 'PE'
        ],
        2 => [
            'label' => 'Falta de tiempo', 'value' => 'FT'
        ],
        3 => [
            'label' => 'Otro ¿cual?', 'value' => 'OTRO'
        ],
    ],
    'relationships' => [
        0 => [
            'label' => 'Papá', 'value' => 'P'
        ],
        1 => [
            'label' => 'Mamá', 'value' => 'M'
        ],
        2 => [
            'label' => 'Padrastro', 'value' => 'PA'
        ],
        3 => [
            'label' => 'Madrastra', 'value' => 'MA'
        ],
        4 => [
            'label' => 'Tio (a)', 'value' => 'T'
        ],
        5 => [
            'label' => 'Primo (a)', 'value' => 'PR'
        ],
        6 => [
            'label' => 'Hermano (a)', 'value' => 'H'
        ],
        7 => [
            'label' => 'Abuelo (a)', 'value' => 'A'
        ],
        8 => [
            'label' => 'Otro', 'value' => 'O'
        ],
    ],
    'values' => [
        0 => [
            'label' => 'Convivencia', 'value' => 'C'
        ],
        1 => [
            'label' => 'Solidaridad', 'value' => 'S'
        ],
        2 => [
            'label' => 'Respeto a los derechos humanos', 'value' => 'R'
        ],
        3 => [
            'label' => 'Interculturalidad', 'value' => 'I'
        ],
        4 => [
            'label' => 'Pluralidad', 'value' => 'P'
        ],
    ],
    'filter_level' => [
        0 => [
            'label' => 'Representativo', 'value' => 'R'
        ],
        1 => [
            'label' => 'Competitivo', 'value' => 'C'
        ],
        2 => [
            'label' => 'Semillero Formación', 'value' => 'SF'
        ],
        3 => [
            'label' => 'Semillero Transición', 'value' => 'ST'
        ]
    ],
];
