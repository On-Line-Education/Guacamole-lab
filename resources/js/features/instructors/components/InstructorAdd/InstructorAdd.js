import React, { useState, useEffect } from "react";
import "./instructoradd.scss";
import useCreateInstructor from "../../hooks/useCreateInstructor";
import { GuacamoleButton, GuacamoleInput } from "../../../../mui";

export default function InstructorAdd({ refetch }) {
    // Form fields state
    const [newInstructorUsername, setNewInstructorUsername] = useState();
    const [newInstructorPassword, setNewInstructorPassword] = useState();

    // Create Student hook declaration
    const { data, createInstructor } = useCreateInstructor(
        newInstructorUsername,
        newInstructorPassword
    );

    // Refetch logic
    useEffect(() => {
        try {
            refetch();
            if (data.success) close();
        } catch {}
    }, [data]);

    return (
        <div className="instructor-add-container">
            <div className="title instructor-add-title">Dodaj nauczyciela</div>
            <div className="instructor-add-panel">
                <div className="instructor-add-form">
                    <form
                        onSubmit={async (e) => {
                            e.preventDefault();
                            createInstructor();
                        }}
                    >
                        <div className="form-group">
                            <label className="form-label">Nazwa</label>
                            <GuacamoleInput
                                className="form-input"
                                onChange={(e) =>
                                    setNewInstructorUsername(e.target.value)
                                }
                            />
                        </div>
                        <div className="form-group">
                            <label className="form-label">Hasło</label>
                            <GuacamoleInput
                                className="form-input"
                                type="password"
                                onChange={(e) =>
                                    setNewInstructorPassword(e.target.value)
                                }
                            />
                        </div>
                        <div className="panel-actions">
                            <GuacamoleButton type="submit">
                                Dodaj
                            </GuacamoleButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    );
}
