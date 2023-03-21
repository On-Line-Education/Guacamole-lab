import React, { useState, useEffect } from "react";
import FileInput from "../../../../components/FileInput/FileInput";
import { GuacamoleButton } from "../../../../mui";
import useImportComputers from "../../hooks/useImportComputers";
import "./computerimport.scss";

export default function ComputerImport({ refetch }) {
    // Form fields state
    const [file, setFile] = useState("");
    const [fileName, setFileName] = useState("");

    // Import Computers hook declaration

    const { data, importComputers } = useImportComputers(file);

    // Refetch logic
    useEffect(() => {
        try {
            if (data.success) {
                refetch();
            }
        } catch {}
    }, [data]);

    return (
        <div className="computer-import-container">
            <div className="title computer-import-title">
                Importuj komputery z pliku .csv
            </div>
            <div className="panel computer-import-panel">
                <form
                    className="panel-form import-form"
                    onSubmit={(e) => {
                        e.preventDefault();

                        importComputers();
                    }}
                >
                    <div className="form-group">
                        <label className="form-label">Wybierz plik .csv</label>
                        <FileInput
                            setFile={setFile}
                            setFileName={setFileName}
                            fileName={fileName}
                        />
                    </div>
                    <div className="form-actions computer-import-actions">
                        <GuacamoleButton
                            type="submit"
                            sx={{ width: "40%" }}
                            disabled={!file}
                        >
                            Importuj
                        </GuacamoleButton>
                    </div>
                </form>
            </div>
        </div>
    );
}
