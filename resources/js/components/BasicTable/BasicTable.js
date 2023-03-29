import React, { useMemo } from "react";
import { useTable, useRowSelect } from "react-table";
import "./basictable.scss";

export default function BasicTable({
    tableColumns,
    tableData,
    selectRow,
    selectedRow,
    numbered = false,
}) {
    // cache data from api using useMemo react hook

    const columns = useMemo(() => tableColumns, []);
    const data = useMemo(() => tableData, []);

    // create table instance using react-table library, for more check official react-table documentation

    const { getTableProps, getTableBodyProps, rows, prepareRow, state } =
        useTable(
            {
                columns,
                data,
            },
            useRowSelect
        );

    if (tableData.length < 1) return "Brak elementów do wyświetlenia";

    return (
        <table {...getTableProps()} className="basic-table">
            <tbody {...getTableBodyProps()}>
                {rows.map((row, i) => {
                    prepareRow(row);
                    return (
                        <tr
                            {...row.getRowProps()}
                            className={`table-row ${
                                row.original === selectedRow ? "active" : ""
                            }`}
                            onClick={() => {
                                selectRow(row.original);
                            }}
                        >
                            {numbered ? <td className="id">{i + 1}</td> : ""}
                            {row.cells.map((cell) => {
                                return (
                                    <td
                                        className={`table-cell ${cell.column.id}`}
                                        {...cell.getCellProps()}
                                    >
                                        {cell.render("Cell")}
                                    </td>
                                );
                            })}
                        </tr>
                    );
                })}
            </tbody>
        </table>
    );
}
