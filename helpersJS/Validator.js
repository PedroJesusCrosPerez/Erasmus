class Validator {
    // Properties
    constructor() {
        this.errors = {};
    }

    // Getters and Setters
    getErrors() {
        return this.errors;
    }

    setErrors(fieldName, errorType, errorMessage) {
        if (!this.errors[fieldName]) {
            this.errors[fieldName] = {};
        }
        this.errors[fieldName][errorType] = errorMessage;
    }

    getError(fieldName, errorType) {
        return this.errors[fieldName] && this.errors[fieldName][errorType];
    }

    // Methods
    isError() {
        return Object.keys(this.errors).length > 0;
    }

    showErrors() {
        if (this.isError()) {
            for (const [fieldName, errorTypes] of Object.entries(this.errors)) {
                for (const [errorType, errorMessage] of Object.entries(errorTypes)) {
                    console.log(`${fieldName} - ${errorType}: ${errorMessage}`);
                }
            }
        } else {
            console.log("¡¡No se han encontrado errores!!");
        }
    }

    // Validate
    isString(fieldName, value, errorMessage) {
        if (typeof value !== 'string') {
            this.setErrors(fieldName, 'isString', errorMessage);
        }
    }

    string(fieldName, value, errorMessage, minLength, maxLength) {
        const regex = new RegExp(`^.{${minLength},${maxLength}}$`);
        if (typeof value !== 'string' || !regex.test(value)) {
            this.setErrors(fieldName, 'stringLength', errorMessage);
            return false;
        }
        return true;
    }

    stringRegex(fieldName, value, regex, errorMessage) {
        if (!regex.test(value)) {
            this.setErrors(fieldName, 'stringRegex', errorMessage);
            return false;
        }
        return true;
    }

    stringEnum(fieldName, value, arr, errorMessage) {
        if (!arr.includes(value)) {
            this.setErrors(fieldName, 'stringEnum', errorMessage);
            return false;
        }
        return true;
    }

    stringEnum2(fieldName, value, arr, errorMessage) {
        for (let i = 0; i < arr.length; i++) {
            if (arr[i] !== value) {
                this.setErrors(fieldName, 'stringEnum', errorMessage);
                return false;
            }
        }
        return true;
    }

    isInt(variant, fieldName, errorMessage) {
        if (typeof variant !== 'number' || !Number.isInteger(variant)) {
            this.setErrors(fieldName, 'isInt', errorMessage);
        }
    }

    isNumeric(variant, fieldName, errorMessage) {
        if (typeof variant !== 'number' || isNaN(variant)) {
            this.setErrors(fieldName, 'isNumber', errorMessage);
        }
    }

    isEmpty(variable, fieldName, errorMessage) {
        if (!variable) {
            this.setErrors(fieldName, 'empty', errorMessage);
        }
    }

    isExist(variable, fieldName, errorMessage) {
        if (variable === undefined) {
            this.setErrors(fieldName, 'exist', errorMessage);
        }
    }

    isNotNull(variable, fieldName, errorMessage) {
        if (variable !== null) {
            this.setErrors(fieldName, 'isNotNull', errorMessage);
        }
    }

    isNull(variable, fieldName, errorMessage) {
        if (variable === null) {
            this.setErrors(fieldName, 'isNull', errorMessage);
        }
    }

    // JSON
    static isJSON(cadena) {
        try {
            JSON.parse(cadena);
            return true;
        } catch (error) {
            return false;
        }
    }

    toJSON() {
        return JSON.stringify(this);
    }
}