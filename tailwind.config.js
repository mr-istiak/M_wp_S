module.exports={
    mode:'jit',
    purge:[
        '*.php',
        './inc/**/*.php',
        './tamplate-parts/**/*.php',
        './dist/js/**/*.js'
    ],
    darkMode: false,
    theme:{
        extend:{
            fontFamily: {
                'Poppins': [ "Poppins" ,'ui-serif', 'Georgia', 'Cambria', "Times New Roman", 'Times', 'serif' ]
            }
        }
    },
    variants:{
        extend:{

        }
    },
    plugins:[

    ]
};
