import React from "react";
import { GuacamoleButton, GuacamoleInput } from "../../../../mui";
import "./computerimport.scss";

export default function ComputerImport() {
    return (
        <div className="computer-import-container">
            <div className="title computer-import-title">
                Importuj komputery z pliku .csv
            </div>
            <div className="panel computer-import-panel">
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
                    <div className="form-actions computer-import-actions">
                        <GuacamoleButton type="submit" sx={{ width: "40%" }}>
                            Importuj
                        </GuacamoleButton>
                    </div>
                </form>
            </div>
        </div>
    );
}
