import React, { useState, useEffect } from "react";
import "./connect.scss";
import { GuacamoleButton } from "../../../../mui";
import useConnect from "../../hooks/useConnect";
import LoadingSpinner from "../../../../components/LoadingSpinner/LoadingSpinner";

export default function Connect({ selectedLesson, loading }) {
    const { connect } = useConnect(
        selectedLesson ? selectedLesson.lecture.id : undefined
    );

    console.log(selectedLesson);
    return (
        <div className="lesson-connect-container">
            <div className="lesson-connect-title">Połącz</div>
            <div className="lesson-connect-panel">
                {selectedLesson ? (
                    <>
                        {loading ? (
                            <LoadingSpinner />
                        ) : (
                            <div className="connection-details">
                                <div className="detail-group">
                                    <label className="detail-label">
                                        Nauczyciel:
                                    </label>
                                    <div className="detail-value">
                                        {
                                            selectedLesson.lecture.instructor
                                                .username
                                        }
                                    </div>
                                </div>
                                <div className="detail-group">
                                    <label className="detail-label">
                                        Sala:
                                    </label>
                                    <div className="detail-value">
                                        {selectedLesson.lecture.class_room.name}
                                    </div>
                                </div>
                                <div className="detail-group">
                                    <label className="detail-label">
                                        Czas zajęć:
                                    </label>
                                    <div className="detail-value">
                                        {selectedLesson.lecture.start.slice(6)}-{" "}
                                        {selectedLesson.lecture.end.slice(6)}
                                    </div>
                                </div>
                                <div className="detail-group">
                                    <label className="detail-label">
                                        Status:
                                    </label>
                                    <div className="detail-value">
                                        {selectedLesson.lecture.started ? (
                                            <>Lekcja już trwa</>
                                        ) : (
                                            <>Lekcja się jeszcze nie zaczęła</>
                                        )}
                                    </div>
                                </div>
                            </div>
                        )}
                        <div className="panel-actions">
                            <GuacamoleButton
                                disabled={Boolean(
                                    !selectedLesson.lecture.started
                                )}
                                onClick={() => connect()}
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
