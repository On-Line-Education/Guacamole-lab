import React from "react";
import { GuacamoleButton, GuacamoleInput } from "../../../../mui";
import "./studentimport.scss";

export default function StudentImport() {
    return (
        <div className="student-import-container">
            <div className="title student-import-title">
                Importuj uczniów z pliku .csv
            </div>
            <div className="panel student-import-panel">
                <form className="panel-form import-form">
                    <div className="form-group">
                        <label className="form-label">Wybierz plik .csv</label>
                        <GuacamoleInput
                            className="form-input"
                            variant="outlined"
                            size="small"
                            id="import-file"
                        />
                    </div>
                    <div className="form-actions student-import-actions">
                        <GuacamoleButton type="submit" sx={{ width: "40%" }}>
                            Importuj
                        </GuacamoleButton>
                    </div>
                </form>
            </div>
        </div>
    );
}
