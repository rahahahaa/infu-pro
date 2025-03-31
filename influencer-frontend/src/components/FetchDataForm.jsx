import { useState } from "react";

const FetchDataForm = () => {
    const [query, setQuery] = useState("");

    const handleSubmit = (e) => {
        e.preventDefault();
        console.log("Fetching data for:", query);
        // API Call Logic Here
    };

    return (
        <div className="flex items-center justify-center min-h-screen bg-gray-100">
            <div className="bg-white shadow-md rounded-lg p-6 w-96">
                <h2 className="text-2xl font-semibold mb-4 text-center">Fetch API Data</h2>
                <form onSubmit={handleSubmit} className="space-y-4">
                    <input
                        type="text"
                        className="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                        placeholder="Enter query..."
                        value={query}
                        onChange={(e) => setQuery(e.target.value)}
                    />
                    <button
                        type="submit"
                        className="w-full bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600 transition"
                    >
                        Fetch Data
                    </button>
                </form>
            </div>
        </div>
    );
};

export default FetchDataForm;
