import React, { useState, useEffect } from "react";
import "./connect.scss";
import { GuacamoleButton } from "../../../../mui";

export default function Connect({ selectedLesson, loading }) {
    return (
        <div className="lesson-connect-container">
            <div className="lesson-connect-title">Połącz</div>
            <div className="lesson-connect-panel">
                {selectedLesson ? (
                    <>
                        <div className="connection-details">
                            <div className="detail-group">
                                <label className="detail-label">
                                    Nauczyciel:
                                </label>
                                <div className="detail-value">
                                    {selectedLesson.instructor.username}
                                </div>
                            </div>
                            <div className="detail-group">
                                <label className="detail-label">Sala:</label>
                                <div className="detail-value">
                                    {selectedLesson.class_room.name}
                                </div>
                            </div>
                            <div className="detail-group">
                                <label className="detail-label">
                                    Czas zajęć:
                                </label>
                                <div className="detail-value">
                                    {selectedLesson.start.slice(6)} -{" "}
                                    {selectedLesson.end.slice(6)}
                                </div>
                            </div>
                            <div className="detail-group">
                                <label className="detail-label">Status:</label>
                                <div className="detail-value">
                                    {selectedLesson.started ? (
                                        <>Lekcja już trwa</>
                                    ) : (
                                        <>Lekcja się jeszcze nie zaczęła</>
                                    )}
                                </div>
                            </div>
                        </div>
                        <div className="panel-actions">
                            <GuacamoleButton
                                disabled={Boolean(!selectedLesson.started)}
                            >
                                Połącz
                            </GuacamoleButton>
                        </div>
                    </>
                ) : (
                    <div className="select-lesson-notice">Wybierz lekcję</div>
                )}
            </div>
        </div>
    );
}
