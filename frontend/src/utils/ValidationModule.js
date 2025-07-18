import { z } from 'zod'

// Схемы для валидации на input - проверка на недопустимые символы
const InputSchemas = {
    nameInput: z
        .string()
        .min(1, 'Введите имя')
        .refine(val => val.length === 0 || /^[А-ЯЁа-яё\s-]+$/.test(val), 'Допускается только кириллица, пробелы и дефисы'),
    
    emailInput: z
        .string()
        .min(1, 'Введите email')
        .refine(val => val.length === 0 || !val.includes('..'), 'Email не может содержать две точки подряд')
        .refine(val => val.length === 0 || !/\s/.test(val), 'Email не может содержать пробелы'),
    
    phoneInput: z
        .string()
        .min(1, 'Ввведите номер телефона')
        .max(12, 'Номер должен содержать не более 11 цифр')
        .refine(val => val.length === 0 || /^[\+]?[0-9]*$/.test(val), 'Разрешены только цифры и + в начале'),

    passwordDebounced: z
        .string()
        .min(1, 'Введите пароль')
};


// Схемы для валидации на debouncedInput - проверка длины и допустимый формат
const DebouncedInputSchemas = {
    nameDebounced: z
        .string()
        .refine(val => val.length === 0 || val.length >= 2, 'Имя должно содержать минимум 2 символа')
        .regex(
          /^[А-ЯЁ][а-яё]+([-\s][А-ЯЁ][а-яё]+)*$/,
          'Неверный формат имени: каждая часть должна начинаться с заглавной буквы',
        )
        .refine(val => val.trim().length > 0, 'Имя не может состоять из пробелов'),

    
    emailDebounced: z
        .string()
        .email('Некорректный формат email'),
    
    phoneDebounced: z
        .string()
        .refine(
            (val) => {
                const normalized = val.startsWith('+') ? val : `+${val}`;
                return normalized.match(/^\+?[78][0-9]{10}$/);
            },
            {
                message: 'Номер должен начинаться с +7 или +8 и содержать 11 цифр',
            }
        )
        .refine((val) => /^[0-9]+$/.test(val.replace(/^\+?[78]/, '')), {
            message: 'Номер должен содержать только цифры после +',
        }),
    
    passwordDebounced: z
        .string()
        .refine(val => val.length === 0 || val.length >= 6, 'Пароль должен содержать минимум 6 символов')
        .refine(val => val.length === 0 || /[A-ZА-ЯЁ]/.test(val), 'Должна быть хотя бы одна заглавная буква')
        .refine(val => val.length === 0 || /[0-9]/.test(val), 'Должна быть хотя бы одна цифра'),
};

// Схемы для валидации на blur - полная проверка
const BlurSchemas = {
    nameBlur: z
        .string()
        .min(1, 'Введите имя')
        .min(2, 'Имя должно содержать минимум 2 символа')
        .max(50, 'Имя не может быть длиннее 50 символов')
        .regex(/^[А-ЯЁа-яё\s-]+$/, 'Имя может содержать только кириллицу, пробелы и дефисы')
        .regex(
          /^[А-ЯЁ][а-яё]+([-\s][А-ЯЁ][а-яё]+)*$/,
          'Неверный формат имени: каждая часть должна начинаться с заглавной буквы',
        )
        .refine(val => val.trim().length > 0, 'Имя не может состоять из пробелов'),
    
    emailBlur: z
        .string()
        .min(1, 'Введите email')
        .email('Некорректный формат email'),
    
    phoneBlur: z
        .string()
        .min(1, 'Введите номер телефона')
        .transform((val) => val.replace(/\s/g, ''))
        .refine(
            (val) => {
                const normalized = val.startsWith('+') ? val : `+${val}`;
                return normalized.match(/^\+?[78][0-9]{10}$/);
            },
            {
                message: 'Номер должен начинаться с +7 или +8 и содержать 11 цифр',
            }
        )
        .refine((val) => /^[0-9]+$/.test(val.replace(/^\+?[78]/, '')), {
            message: 'Номер должен содержать только цифры после +',
        }),
    
    passwordBlur: z
        .string()
        .min(1, 'Введите пароль')
        .min(6, 'Пароль должен содержать минимум 6 символов')
        .regex(/[A-ZА-ЯЁ]/, 'Пароль должен содержать хотя бы одну заглавную букву')
        .regex(/[0-9]/, 'Пароль должен содержать хотя бы одну цифру'),

    passwordLoginBlur: z
        .string()
        .min(1, 'Введите пароль'),
};

// Схемы для финальной валидации форм
const FormSchemas = {
  signUpForm: z.object({
    email: BlurSchemas.emailBlur,
    password: BlurSchemas.passwordBlur,
    name: BlurSchemas.nameBlur,
    phone: BlurSchemas.phoneBlur,
  }),

  loginForm: z.object({
    email: BlurSchemas.emailBlur,
    password: z.string().min(1, 'Пароль обязателен'),
  }),
}

// Экспортируем все схемы
export const ValidationSchemas = {
    input: InputSchemas,
    blur: BlurSchemas,
    debounced: DebouncedInputSchemas, 
    form: FormSchemas,
    email: BlurSchemas.emailBlur,
    password: BlurSchemas.passwordBlur,
    passwordLogin: BlurSchemas.passwordLoginBlur,
    name: BlurSchemas.nameBlur,
    phone: BlurSchemas.phoneBlur,
    signUpForm: FormSchemas.signUpForm,
    loginForm: FormSchemas.loginForm,
};

// Универсальная функция валидации
export function validateField(schema, value) {
  const result = schema.safeParse(value)
  if (result.success) {
    return { success: true, data: result.data }
  }
  const errors = {}
  result.error.issues.forEach((issue) => {
    const path = issue.path.join('.') || 'root'
    if (!errors[path]) {
      errors[path] = []
    }
    errors[path].push(issue.message)
  })
  return { success: false, errors }
}

// Вспомогательные функции
export const ValidationHelpers = {
    validateOnInput: (field, value) => {
        const schema = ValidationSchemas.input[`${field}Input`];
        return schema ? validateField(schema, value) : { success: true };
    },
    
    validateOnBlur: (field, value) => {
        const schema = ValidationSchemas.blur[`${field}Blur`];
        return schema ? validateField(schema, value) : { success: true };
    },
    
    validateOnDebounced: (field, value) => {
        const schema = ValidationSchemas.debounced[`${field}Debounced`];
        return schema ? validateField(schema, value) : { success: true };
    },
    
    validateForm: (formType, data) => {
        const schema = ValidationSchemas.form[formType];
        return schema ? validateField(schema, data) : { success: true };
    },
};