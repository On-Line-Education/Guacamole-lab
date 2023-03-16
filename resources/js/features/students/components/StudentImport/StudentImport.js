import React, { useState } from "react";
import { GuacamoleButton } from "../../../../mui";
import useImportStudents from "../../hooks/useImportStudents";
import FileInput from "../../../../components/FileInput/FileInput";
import "./studentimport.scss";

export default function StudentImport() {
    const [file, setFile] = useState("");
    const [fileName, setFileName] = useState("");

    const [error, data, importStudents] = useImportStudents(file);
    return (
        <div className="student-import-container">
            <div className="title student-import-title">
                Importuj uczniów z pliku .csv
            </div>
            <div className="panel student-import-panel">
                <form className="panel-form import-form">
                    <div className="form-group">
                        <label className="form-label">Wybierz plik .csv</label>
                        <FileInput
                            setFile={setFile}
                            setFileName={setFileName}
                            fileName={fileName}
                        />
                    </div>
                    <div className="form-actions student-import-actions">
                        <GuacamoleButton
                            sx={{ width: "40%" }}
                            disabled={!file}
                            onClick={() => importStudents()}
                        >
                            Importuj
                        </GuacamoleButton>
                    </div>
                </form>
            </div>
        </div>
    );
}
