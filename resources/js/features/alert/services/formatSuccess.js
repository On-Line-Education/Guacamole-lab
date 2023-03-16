export function formatSuccess(successResponse) {
    switch (successResponse) {
        case "LOGIN_SUCCESS":
            return {
                title: "Pomyślnie zalogowano",
                message: "",
            };
        case "LOGOUT_SUCCESS":
            return {
                title: "Pomyślnie wylogowano",
                message: "",
            };
        case "CLASSROOM_CREATE_SUCCESS":
            return {
                title: "Pomyślnie stworzono nową klasę",
                message: "",
            };
        case "CLASSROOM_DELETE_SUCCESS":
            return {
                title: "Pomyślnie usunięto klasę",
                message: "",
            };
        case "COMPUTER_CREATE_SUCCESS":
            return {
                title: "Pomyślnie stworzono nowy komputer",
                message: "",
            };
        case "COMPUTER_DELETE_SUCCESS":
            return {
                title: "Pomyślnie usunięto komputer",
                message: "",
            };
        case "COMPUTER_EDIT_SUCCESS":
            return {
                title: "Pomyślnie zmieniono dane komputera",
                message: "",
            };
        case "COMPUTER_IMPORT_SUCCESS":
            return {
                title: "Pomyślnie zaimportowano komputery",
                message: "",
            };
        case "STUDENT_CREATE_SUCCESS":
            return {
                title: "Pomyślnie stworzono ucznia",
                message: "",
            };
        case "STUDENT_DELETE_SUCCESS":
            return {
                title: "Pomyślnie usunięto ucznia",
                message: "",
            };
        case "STUDENT_EDIT_SUCCESS":
            return {
                title: "Pomyślnie zmieniono dane ucznia",
                message: "",
            };
        case "STUDENT_IMPORT_SUCCESS":
            return {
                title: "Pomyślnie zaimportowano uczniów",
                message: "",
            };
        case "GROUP_CREATE_SUCCESS":
            return {
                title: "Pomyślnie stworzono grupę",
                message: "",
            };
        case "GROUP_UNASSIGN_SUCCESS":
            return {
                title: "Pomyślnie zabrano grupę",
                message: "",
            };
        case "GROUP_DELETE_SUCCESS":
            return {
                title: "Pomyślnie usunięto grupę",
                message: "",
            };
        case "LESSON_CREATE_SUCCESS":
            return {
                title: "Pomyślnie utworzono rezerwacje",
                message: "",
            };
        case "LESSON_DELETE_SUCCESS":
            return {
                title: "Pomyślnie usunięto rezerwacje",
                message: "",
            };

        default:
            return {
                title: "Akcja udana",
                message: "",
            };
    }
}
